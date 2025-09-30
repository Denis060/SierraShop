CREATE DATABASE job_aggregator;
USE job_aggregator;
USE citiguard;
show tables;
describe reports;
select * from reports;
select * from admins;
select * from reports;
ALTER TABLE reports
  ADD COLUMN voice_file VARCHAR(255) NULL,
  ADD COLUMN user_ip VARCHAR(45) NULL,
  ADD COLUMN user_lat VARCHAR(32) NULL,
  ADD COLUMN user_lng VARCHAR(32) NULL;
  
ALTER TABLE reports
  DROP COLUMN voice_file,
  DROP COLUMN user_ip,
  DROP COLUMN user_lat,
  DROP COLUMN user_lng;

CREATE TABLE saved_jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    job_id INT NOT NULL,
    saved_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);