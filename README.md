# Merchant Assistant Chat Bot

Merchant Assistant is a chat bot designed to assist merchants with managing their BigCommerce store data using BigQuery and Vertex AI. The chat bot interacts with the BigCommerce database to retrieve information related to customers, orders, products, and order line items. It then processes the data using Laravel and provides user-friendly responses.

## Technologies Used

- BigQuery: Used for querying the BigCommerce database.
- Vertex AI: Provides machine learning tools for creating the chat bot.
- Laravel: Framework used to build the BigCommerce merchant app and integrate with the chat bot.
- Code-Bison: Tool used to generate BigQuery table schema.
- Text-Bison: Tool used to make the chat bot responses user-friendly.

## Setup Instructions

1. Clone the repository:

   
   git clone https://github.com/your-username/merchant-assistant.git
   cd merchant-assistant
   

2. Install dependencies:

   
   composer install
   

3. Configure the BigCommerce API credentials in the `.env` file:

   
   BIGCOMMERCE_CLIENT_ID=your-client-id
   BIGCOMMERCE_CLIENT_SECRET=your-client-secret
   BIGCOMMERCE_ACCESS_TOKEN=your-access-token
   

4. Configure Vertex AI for building the chat bot:

   - Integrate the deployed models with your Laravel app.

5. Implement the chat bot logic in your Laravel app:

   - Use Vertex AI's endpoints to communicate with the chat bot models.
   - Process user queries and trigger BigQuery queries based on user input.

6. Use Text-Bison to make the chat bot responses user-friendly:

   - Convert technical data into easily understandable language.
   - Customize responses for various user interactions.

7. Run the Laravel development server:

   
   php artisan serve
   

## How the Chat Bot Works

1. User interacts with the chat bot via the merchant app.
2. The chat bot processes the user's query and sends it to the deployed Vertex AI model(code-bison).
3. The model processes the query and responds with the relevant information in form of SQL query.
4. Chatbot triggers BigQuery queries to retrieve dataof BigCommerce from Google Bigquery.
5. The chat bot's response is processed by Text-Bison to make it user-friendly.
6. The transformed response is displayed to the user in the merchant app.

## Contributing

Contributions to Merchant Assistant are welcome! Feel free to submit pull requests to improve the functionality, user experience, or documentation.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.