# Merchant Assistant Chat Bot

Merchant Assistant is a chat bot designed to assist merchants with managing their BigCommerce store data using BigQuery and Vertex AI. The chat bot interacts with the BigCommerce database to retrieve information related to customers, orders, products, and order line items. It then processes the data using Laravel and provides user-friendly responses.

## How the Chat Bot Works

1. User interacts with the chat bot via the merchant app.
2. The chat bot processes the user's query and sends it to the deployed Vertex AI model(code-bison).
3. The model processes the query and responds with the relevant information in form of SQL query.
4. Chatbot triggers BigQuery queries to retrieve dataof BigCommerce from Google Bigquery.
5. The chat bot's response is processed by Text-Bison to make it user-friendly.
6. The transformed response is displayed to the user in the merchant app.

## Technologies Used

- BigQuery: Used for querying the BigCommerce database.
- Vertex AI: Provides machine learning tools for creating the chat bot.
- Laravel: Framework used to build the BigCommerce merchant app and integrate with the chat bot.
- Code-Bison: Tool used to generate BigQuery table schema.
- Text-Bison: Tool used to make the chat bot responses user-friendly.

## Laravel Setup Instructions

1. Clone the repository:

    ```
   git clone https://github.com/your-username/merchant-assistant.git
   cd merchant-assistant
    ```

2. Install dependencies:

    ```
   composer install
    ```

3. Configure the BigCommerce API credentials in the `.env` file:

    ```
   BIGCOMMERCE_CLIENT_ID=your-client-id
   BIGCOMMERCE_CLIENT_SECRET=your-client-secret
   BIGCOMMERCE_ACCESS_TOKEN=your-access-token
    ```

4. Run the Laravel development server:

    ```
   php artisan serve
    ```

# Text to SQL API using Flask and Google Vertex API

This project provides a Python script that serves as an API for converting natural language text into SQL queries using the Google Vertex AI Natural Language Understanding API. The API is built using Flask, a lightweight web framework, and requires Python 3.8 or higher.

## Prerequisites

Before you can use this API, make sure you have the following:

- Python 3.8 or higher installed
- Google Cloud Platform account with access to the Vertex AI Natural Language Understanding API

## Flask Setup

1. Clone this repository to your local machine:

    ```
    git clone https://github.com/your-username/text-to-sql-api.git
    ```

2. Set up authentication for your Google Cloud Platform account:

   Follow the [Google Cloud authentication guide](https://cloud.google.com/docs/authentication/getting-started) to set up your credentials.

3. Replace the placeholder values in `textToSql.py` with your actual Google Cloud API credentials:

    ```python
    PROJECT_ID = 'your-project-id'
    REGION = 'your-region'
    ```

## Usage

To use the Text to SQL API, follow these steps:

1. Open a terminal and navigate to the project directory.

2. Run the Flask server:

    ```
    python3 textToSql.py
    ```

3. The API server will start running locally. You can access the API at `http://localhost:5000`.

4. Send a GET request to the API with your natural language text as a query parameter to convert it to an SQL query. For example:

    ```
    http://127.0.0.1:5000/api/bigquery?query=Give%20me%20the%20last%20order%20id
    ```

5. The API will respond with a JSON object containing the generated SQL query.
API will respond with a JSON object like: 
   ```
   {
   "response": "I see. You want to know the last order ID. Let me check my database. It looks like the last order ID is 167."
   }
   ```

## Cleanup

Remember to stop the Flask server when you're done testing:

1. In the terminal where the server is running, press `Ctrl + C` to stop the server.



## Contributing

Contributions to Merchant Assistant are welcome! Feel free to submit pull requests to improve the functionality, user experience, or documentation.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.


