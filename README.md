# Smart-Stock
This module helps the user to identify dates when the stock can be bought and sold. 
Assumptions: Any Backend server (LAMP,WAMP,XAMPP or anything similar) is up and running.
To set this up please follow the following steps:
1. The smart_stock.sql file should first be imported to the database (db name: 'smart_stock').
2. Take pull of the code(or download) on the folder which projects the same on the http:// request on the browser. (within htdocs in case of XAMPP)
3. Open the file connection.php within db folder and change the username and password accordingly.
4. On the browser(preferrably Chrome) please open the localhost(depends on each server)/SmartStock.

A dashboad will appear with Analyse Stock heading. This means the project setup is complete.

Submodules and its features:
1. <b>Stock Details(Add/View):</b> This module is for inserting the closing prices of stock for each day. The values are stock name, date, price. Bulk CSV is also supported. Also the same can be edited from vthe view screen.
2. <b>Stock Transactions(Buy/Sell):</b> This module is for buying and selling of stock. One factor to keep in mind here is that the latest price of the stock is considered while buying and purchasing. It is not dependant on whether the dtock detail is present for that particular day or not.
3. <b>Reports(Inventory/Transaction):</b> This module is used to show inventory lot(date) wise for each stock and transaction report shows the purchase and selling off details of the stocks.
4. <b>Setting:</b> This contains a setting which allows the number of transactions at a time(stock wise) and the same is reflected on the buying stock and selling stock feature.
5. <b>Stock Analysis:</b> Here one can select the stock name and determine the date range the stock has to be analysed. The dashboard appears where the analysis like below would be displayed:
a) Profit
b) Mean
c) Standard Deviation
d) Best date to buy stock
e) Best date to sell stock
f) Transaction wise profit/loss incurred.



