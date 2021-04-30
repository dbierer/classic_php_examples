#!/bin/sh
mongorestore -d sweetscomplete -c customers ./dump/sweetscomplete/customers.bson
mongorestore -d sweetscomplete -c products ./dump/sweetscomplete/products.bson
mongorestore -d sweetscomplete -c purchases ./dump/sweetscomplete/purchases.bson
