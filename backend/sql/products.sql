select prds.id, prds.name as product_name, prds.description, prds.price, cat.name as cat_name, img.image_url from 
products as prds inner join categories as cat on prds.id = cat.id
inner join images as img on prds.id = img.product_id 