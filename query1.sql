SELECT b.date,b.po_num,b.qty,a.sku,a.pid FROM products AS a, purchases AS b WHERE a.sku = b.sku ORDER BY b.date

