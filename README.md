# Multi vendor E-commerce System

* Framework
  - Codeigniter
  - MySQL
  - HTML
 
* Jobs
  - Design System architecture
  - Database Design
  - HTML Design (Bootstrap 4)
  
  
* Description
  - multi vendor system (three types of user) 
           - Administrator
	- Sellers
	- Customers
  - Here seller can register account for selling products in out portal (like amazon)
  - seller can uploads product in various types of category which are defined by admin.
  - seller can upload product in 3 ways.
- single product upload
- import product using excel sheet.
- copy product using supc number. 

  - once seller upload product admin have authority to approve or reject product.
  - approval product will goes in non live product and reject product goes in rejected product.
  - seller can live product for selling from list of non live products.
  - live product user can purchase from site.

  - In project we set a payment method.
           - cod
           - payumoney

  - we also have an experience for paypal, stripe and rajorpay gateways.
  - For shipping product, I set list of shipping method.
           - Fedex
           - DTDC 
           - indiapost

   - As per e-commerce site I also integrated sms facility for order status.


* Install
  - Clone
  - Edit Database config in /.evn file & config/database.php
  - Clear config cache: ```php artisan config:cache```
  - Running Migrations Database: ```php artisan migrate```
  - Run server: ```php artisan serve```
