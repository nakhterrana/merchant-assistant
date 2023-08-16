from flask import Flask, jsonify, request
import vertexai
import random
from google.cloud import bigquery
from vertexai.language_models import TextGenerationModel, \
    CodeGenerationModel

# List of apology phrases for potential disruptions
apology_phrases = [
    "I sincerely apologize for any inconvenience caused by the unexpected interruption in our conversation.",
    "My deepest apologies for the sudden disruption in our chat. Please know that I'm here to assist you.",
    "I'm sorry for the technical hiccup earlier. Let's continue our conversation without any interruptions.",
    "Apologies for the brief interruption. I'm back and ready to help you with any questions you have.",
    "Sorry about the disruption. Let's pick up where we left off and get back on track.",
    "I regret the interruption in our chat. Let's move forward and address your queries.",
    "Please accept my apologies for the chat disruption. I'm at your service now.",
    "I apologize for any frustration caused by the interruption. How can I assist you further?",
    "My apologies for the unexpected pause in our conversation. Let's continue with our discussion.",
    "Sorry for the chat hiccup. I'm here to provide you with the information you need.",
    "I'm sorry our chat got momentarily derailed. Let's refocus on your questions.",
    "Apologies for the technical blip. Let's carry on with our conversation without any issues.",
    "Sorry for any confusion the interruption might have caused. How can I make it up to you?",
    "I regret any inconvenience caused by the disruption. Let's get back on track.",
    "Please accept my apologies for the chat interruption. Your satisfaction is my priority.",
    "I'm sorry the chat hit a bump. Let's continue smoothly from here on out.",
    "Apologies for the unexpected pause. Let's proceed with our discussion seamlessly.",
    "Sorry for the momentary disruption. Let's make our conversation productive.",
    "I apologize for any disturbance you experienced. Let's continue with our interaction.",
    "My sincerest apologies for the chat interruption. Your understanding is greatly appreciated."
]
# Initialize Flask app
app = Flask(__name__)

# Constants for dataset and project IDs
dataset_id = "folio3bigaihackathon"
PROJECT_ID = "merchant-assistant-395407"

# Initialize Vertex AI
vertexai.init(project=PROJECT_ID, location="us-central1")
# Initialize BigQuery client
client = bigquery.Client(project=PROJECT_ID)

# Function to execute SELECT queries on BigQuery
def run_select_query(sql_statement):
    client = bigquery.Client()
    query_job = client.query(sql_statement)
    query_results = query_job.result()
    return query_results.to_dataframe()

# Schema details for various tables
TABLE_SCHEMA_STR = f'''
[SCHEMA details for table `{PROJECT_ID}.{dataset_id}.bc_customer`]:
Full table name: {PROJECT_ID}.{dataset_id}.bc_customer - Column: customer_id - Data Type: INT64 - Primary Key: False - Foreign Key: True - Description: The unique identifier for each customer.
Full table name: {PROJECT_ID}.{dataset_id}.bc_customer - Column: full_name - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The full name of the customer.
Full table name: {PROJECT_ID}.{dataset_id}.bc_customer - Column: email - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The email address of the customer.
Full table name: {PROJECT_ID}.{dataset_id}.bc_customer - Column: date_created - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the customer record was created.
Full table name: {PROJECT_ID}.{dataset_id}.bc_customer - Column: date_modified - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the customer record was last modified.
[SCHEMA details for table `{PROJECT_ID}.{dataset_id}.bc_order`]:
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: order_id - Data Type: INTEGER - Primary Key: False - Foreign Key: True - Description: The unique identifier for the order.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: order_status - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The textual representation of the order status.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: order_created_date_time - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the order was created.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: customer_id - Data Type: INTEGER - Primary Key: False - Foreign Key: True - Description: The identifier for the customer who placed the order.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: payment_status - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The status of the payment for the order.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: sub_total_including_tax - Data Type: NUMERIC - Primary Key: False - Foreign Key: False - Description: The subtotal of the order including taxes.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: total_including_tax - Data Type: NUMERIC - Primary Key: False - Foreign Key: False - Description: The total order amount including taxes.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order` - Column: last_updated_datetime - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the order was last updated.
[SCHEMA details for table `{PROJECT_ID}.{dataset_id}.bc_product`]:
Full table name: `{PROJECT_ID}.{dataset_id}.bc_product` - Column: product_id - Data Type: INTEGER - Primary Key: False - Foreign Key: True - Description: The unique identifier of the product.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_product` - Column: product_name - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The name of the product.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_product` - Column: product_type - Data Type: STRING - Primary Key: False - Foreign Key: False - Description: The type of the product (e.g., physical, digital).
Full table name: `{PROJECT_ID}.{dataset_id}.bc_product` - Column: price - Data Type: NUMERIC - Primary Key: False - Foreign Key: False - Description: The price of the product.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_product` - Column: last_updated_datetime - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the product information was last updated.
[SCHEMA details for table `{PROJECT_ID}.{dataset_id}.bc_order_line_items`]:
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: order_line_item_id - Data Type: INTEGER - Primary Key: False - Foreign Key: False - Description: The unique identifier of the order line item.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: order_id - Data Type: INTEGER - Primary Key: False - Foreign Key: True - Description: The identifier of the order associated with this line item.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: product_id - Data Type: INTEGER - Primary Key: False - Foreign Key: False - Description: The identifier of the product associated with this line item.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: quantity - Data Type: INTEGER - Primary Key: False - Foreign Key: False - Description: The quantity of the product in this line item.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: total_inc_tax - Data Type: NUMERIC - Primary Key: False - Foreign Key: False - Description: The total amount of the line item including tax.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: total_tax - Data Type: NUMERIC - Primary Key: False - Foreign Key: False - Description: The total tax amount for the line item.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: is_refunded - Data Type: BOOLEAN - Primary Key: False - Foreign Key: False - Description: Indicates whether the line item has been refunded.
Full table name: `{PROJECT_ID}.{dataset_id}.bc_order_line_items` - Column: last_updated_datetime - Data Type: DATETIME - Primary Key: False - Foreign Key: False - Description: The date and time when the line item information was last updated.
'''

# Sample user question
QUESTION = '[Q]: Give me last customer with date and name'

# Sample examples for user questions and SQL queries
examples = [
    {
        "Question": "[Q]: tell me the customer who purchases most product 77?",
        "SQL": f'''[SQL]: SELECT c.full_name
            FROM `{PROJECT_ID}.{dataset_id}.bc_order_line_items` AS oli
            INNER JOIN `{PROJECT_ID}.{dataset_id}.bc_order` AS o ON oli.order_id = o.order_id
            INNER JOIN `{PROJECT_ID}.{dataset_id}.bc_product` AS p ON oli.product_id = p.product_id
            INNER JOIN `{PROJECT_ID}.{dataset_id}.bc_customer` AS c ON o.customer_id = c.customer_id
            WHERE p.product_id = 77
            GROUP BY c.full_name
            ORDER BY COUNT(*) DESC
            LIMIT 1
        '''
    }
]

# Function to concatenate and display example questions and SQL queries
def getExamples():
    r = ''
    for example in examples[:2]:
        r = '\r\n'.join(
            [r, 'Here is an example of user question and answer SQL.', TABLE_SCHEMA_STR, example['Question'],
             example['SQL']])
    # print(r)
    return r


# Function to display a single user question
def getQuestion(q):
    return "\r\n".join(['Here is an example of user question and answer SQL.', TABLE_SCHEMA_STR, q])


# Function to handle generating SQL from user questions
def handleQuestions(q):
    # Parameters for text generation models
    parameters = {
        "temperature": 0.2,
        "max_output_tokens": 1024
    }
    prefix = '\r\n'.join([
        'You are a SQL expert. Please convert text into GoogleSQL statement. We will first give the dataset schema and then ask a question in text. You are asked to generate SQL statement. Always use EXTRACT method instead of year and month.',
        getExamples(), getQuestion(q)])
    generation_model = CodeGenerationModel.from_pretrained("code-bison@001")
    response = generation_model.predict(prefix=prefix, **parameters)
    generated_sql = response.text.replace("[SQL]: ", "")
    print("Auto Generated SQL is :\r\n")
    print(generated_sql)
    return run_select_query(generated_sql)


handleQuestions(QUESTION)


# Function to convert SQL response to natural language
def handleSqlToNLP(gQueryStatement, userInput):
    print(gQueryStatement)
    json_data = gQueryStatement.to_json(orient="records", indent=4)
    parameters = {
        "temperature": 0.2,
        "max_output_tokens": 256,
        "top_p": 0.8,
        "top_k": 40
    }
    model = TextGenerationModel.from_pretrained("text-bison@001")
    response = model.predict(
        f"""This is the user query : {userInput}
        and here is json response from my database:
        {json_data}. Generate a description for the following in the natural language and if response from my database is empty then return no data found message
         and don't use the word json in the statement. Pretend like you are interactive with the end user """,
        **parameters
    )
    print(response.text)
    return response.text


# Function to handle exceptions when processing user questions
def handleSqlToNLPException(e, userInput):
    pp = {
        "temperature": 0.2,
        "max_output_tokens": 256,
        "top_p": 0.8,
        "top_k": 40
    }
    model = TextGenerationModel.from_pretrained("text-bison@001")
    response = model.predict(
        f"""This is the user query : {userInput} and I got the the exception from code because user ask something out
        of context and my AI model deals only with questions related merchant assistant i.e  Orders, products and
        customer related question. Exception: {e} .
        Generate the apology message in the natural language and don't use any technical term in
        the statement. Pretend like you are interactive with the end user, message should be precisely and do add some emojis in the message for good user experience.
        """,
        **pp
    )
    print(response.text)
    return response.text


# Route for handling API requests
@app.route('/api/bigquery', methods=['GET'])
def hello_world():
    query = request.args.get('query')
    res = 'Please enter your query'
    if query:
        try:
            query = f'[Q]: {query}'
            googleSQLQuery = handleQuestions(query)
            res = handleSqlToNLP(googleSQLQuery, query)
        except Exception as e:
            try:
                res = handleSqlToNLPException(e, query)
            except Exception as e:
                res = random.choice(apology_phrases)

        return jsonify({"response": res})
    else:
        return jsonify({"response": res})


# Run the Flask app
if __name__ == '__main__':
    app.run()
