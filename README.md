# Smart-Stock
This module helps the user to identify dates when the stock can be bought and sold. 
Assumptions: Any Backend server (LAMP,WAMP,XAMPP or anything similar) is up and running.
To set this up please follow the following steps:
1. The smart_stock.sql file should first be imported to the database (db name: 'smart_stock').(If sample data is needed one can use smart_stock_with_sample_data.sql instead)
2. Take pull of the code(or download) on the folder which projects the same on the http:// request on the browser. (within htdocs in case of XAMPP)
3. Open the file connection.php within db folder and change the username and password accordingly.
4. On the browser(preferrably Chrome) please open the localhost(depends on each server)/SmartStock.

A dashboad will appear with Analyse Stock heading. This means the project setup is complete.

Submodules and its features:
1. <b>Stock Details(Add/View):</b> This module is for inserting the closing prices of stock for each day. The values are stock name, date, price. Bulk CSV is also supported. Also the same can be edited from the view screen.
2. <b>Stock Transactions(Buy/Sell):</b> This module is for buying and selling of stock. One factor to keep in mind here is that the latest price of the stock is considered while buying and purchasing. It is not dependant on whether the stock detail is present for that particular day or not.
3. <b>Reports(Inventory/Transaction):</b> This module is used to show inventory lot(date) wise for each stock and transaction report shows the purchase and selling off details of the stocks.
4. <b>Setting:</b> This contains a setting which allows the number of transactions at a time(stock wise) and the same is reflected on the buying stock and selling stock feature.
5. <b>Stock Analysis:</b> Here one can select the stock name and determine the date range the stock has to be analysed. The dashboard appears where the analysis like below would be displayed:
<ul>
<li>a) Profit</li>
<li>b) Mean</li>
<li>c) Standard Deviation</li>
<li>d) Best date to buy stock</li>
<li>e) Best date to sell stock</li>
<li>f) Transaction wise profit/loss incurred.</li>
</ul>


<b>Note: The Stock name will always be stored in the database in capital-case, hence for this module it is case-insensitive. It is suggested to always take the date from the calendar as the input date is taken in mm/dd/yyyy format and stored in the database as yyyy/mm/dd.</b>
