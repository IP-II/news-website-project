CREATE Database ethioNewsDB;
use ethioNewsDB;

-- Create NewsReporters table
CREATE TABLE NewsReporters (
  reporter_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  join_date DATE
);

-- Create News table
CREATE TABLE News (
  news_id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  description TEXT,
  content TEXT,
  reporter_id INT,
  publish_date DATE,
  category VARCHAR(20),
  FOREIGN KEY (reporter_id) REFERENCES NewsReporters(reporter_id)
);
