# Senzor server

This is a simple server application that can be used to test the a sensors capabilities to send data.

## Usage

To use the server, you need to have [Node.js](https://nodejs.org/en/) installed. Then you can run the following commands:

```bash
npm install
```
The server runs on PHP and can be eun either on a dedicated server or on a local machine (_I used XAMPP_).

## Send data

To send data to the server, you need to send a POST request to the server, to the following url:

    <your_ip_address>/senzorserver/post_request.php

Or a Get request to the following url:

    <your_ip_address>/senzorserver/get_request.php

The request should contain the following data:

- `regdata` - The data to be stored in the database

- `regdate` - _Optional_ - The date and time of the data. If not provided, the current date will be used.

## Data Visualization

The data can be visualized by opening the following url in a browser:

    <your_ip_address>/senzorserver/index.php

On this page you can also add new data.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details