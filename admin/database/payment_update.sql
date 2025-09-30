-- Add payment columns to orders table
ALTER TABLE `orders` 
ADD `payment_method` VARCHAR(20) NOT NULL DEFAULT 'cod',
ADD `payment_status` VARCHAR(20) NOT NULL DEFAULT 'pending',
ADD `payment_time` DATETIME NULL,
ADD `payment_transaction_id` VARCHAR(100) NULL;

-- Add index for payment status queries
ALTER TABLE `orders` ADD INDEX `idx_payment_status` (`payment_status`);

-- Add constraints for payment method values
ALTER TABLE `orders` 
ADD CONSTRAINT `chk_payment_method` 
CHECK (`payment_method` IN ('cod', 'bank', 'momo', 'vnpay'));

-- Add constraints for payment status values
ALTER TABLE `orders` 
ADD CONSTRAINT `chk_payment_status` 
CHECK (`payment_status` IN ('pending', 'completed', 'failed', 'refunded', 'cancelled'));

-- Add index for payment status queries
CREATE INDEX idx_payment_status ON orders(payment_status);
