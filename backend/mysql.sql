create table categories (
  id int(11) not null auto_increment,
  name varchar(128) not null,
  description varchar(512),
  primary key (id)
);

create table products (
  id int(11) not null auto_increment,
  cat_id int(11) not null,
  price decimal(10,2) not null,
  description varchar(512) not null,
  primary key (id),
  foreign key (cat_id) references categories(id)
);

create table images (
  id int(11) not null auto_increment,
  product_id int(11) not null,
  image_url varchar(256) not null,
  primary key (id),
  foreign key (product_id) references products(id)
);