# Custom PHP Framework

Project for practice TDD (Test Driven Development) with Custom made PHP Framework and secure communication chanel via Advanced Encryption Standard (AES algorithm).

### Database:
```
CREATE TABLE `user` ( 
  `id` int(11) NOT NULL, 
  `name` varchar(45) DEFAULT NULL, 
  `email` varchar(45) NOT NULL, 
  `password` varchar(250) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

ALTER TABLE `user` 
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `user` 
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
```
### Configuration: /config/DBConfig.php
```
class DBConfig{ 
     public static function get(){ 
        return json_encode([
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'test'
        ]);<br>
    }<br>
}
```


## Author

[Dusan Perisic](http://dusanperisic.com)