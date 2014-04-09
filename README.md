craigscan
=========

A webapp that alerts users via text when a craigslist ad matching their search keywords is available. Users submit their 
phone number, location, keywords, and price threshold. crontask is used on the server every two minutes to run the php script that parses the craigslist search page for a matching listing. Simple HTML DOM Parser is used to help with parsing the page, and PHPMailer is used to send the messages.

Bugs/Limitations
================
- When searching under the housing category, the price is sometimes parsed incorrectly.
- Limited to California areas.
