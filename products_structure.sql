CREATE TABLE "products" ("sku" INTEGER PRIMARY KEY  NOT NULL , "pid" CHAR, "unit" CHAR, "cost" FLOAT, "qty_oh" INTEGER);
CREATE TABLE `purchases` (
  `sku` int(8),
  `po_num` char(32),
  `date` timestamp  DEFAULT CURRENT_TIMESTAMP,
  `qty` int(8),
  `price` decimal(10,2),
  PRIMARY KEY (`sku`,`po_num`)
);
CREATE VIEW "browse" AS select * from products;
