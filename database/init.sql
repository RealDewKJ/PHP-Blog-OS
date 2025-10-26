-- Create database with UTF-8 support
CREATE DATABASE IF NOT EXISTS blog_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE blog_db;

-- Set charset to UTF8 for Thai language support
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET character_set_connection = utf8mb4;
SET character_set_client = utf8mb4;
SET character_set_results = utf8mb4;

CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    author VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    image_data LONGBLOB NULL,
    image_mime_type VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
    image_filename VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Clear existing data and insert sample data
DELETE FROM blogs;
INSERT INTO blogs (title, content, author) VALUES 
('เริ่มต้นเขียน PHP อย่างมืออาชีพ', 'หลายคนเริ่มเรียน PHP จากการทำเว็บง่าย ๆ แต่ในบทความนี้เราจะพาไปรู้จักแนวคิดเชิงลึกและเทคนิคที่นักพัฒนามืออาชีพนิยมใช้.', 'สมชาย ทดสอบ'),
('เข้าใจ JavaScript Async/Await ภายใน 10 นาที', 'Async/Await เป็นฟีเจอร์ที่ช่วยให้โค้ดอ่านง่ายขึ้นมากเมื่อเทียบกับ callback หรือ promise มาดูกันว่ามันทำงานอย่างไรแบบเข้าใจง่าย.', 'กิตติพงษ์ ทดสอบ'),
('สร้าง REST API ด้วย Laravel', 'Laravel ช่วยให้นักพัฒนาสร้าง RESTful API ได้รวดเร็วและปลอดภัย บทความนี้จะแนะนำตั้งแต่เริ่มต้นจนถึงการใช้ Token Authentication.', 'ศิริพร ทดสอบ'),
('Docker คืออะไร และทำไมควรใช้ในการพัฒนาเว็บ', 'Docker ทำให้การพัฒนาเว็บสะดวกขึ้นมาก โดยเฉพาะเมื่อทำงานร่วมกันเป็นทีม มาดูวิธีเริ่มต้นใช้งานกัน.', 'อัญชัน ทดสอบ'),
('TypeScript ดีกว่า JavaScript ยังไง', 'TypeScript กำลังได้รับความนิยมอย่างมาก เพราะช่วยป้องกันข้อผิดพลาดตั้งแต่ตอนเขียนโค้ด มาดูกันว่าทำไมหลายบริษัทถึงเลือกใช้.', 'ปวีณา ทดสอบ'),
('เทคนิค Debugging โค้ดให้ไวขึ้น 3 เท่า', 'Debugging คือทักษะที่นักพัฒนาต้องใช้ทุกวัน บทความนี้รวมเทคนิคและเครื่องมือที่จะช่วยให้คุณหาบั๊กได้ไวกว่าเดิม.', 'ภัทรวดี ทดสอบ'),
('NBA ฤดูกาลใหม่ ใครคือทีมที่น่าจับตา', 'ฤดูกาล NBA ปีนี้เต็มไปด้วยความตื่นเต้น ทีมใหญ่เสริมทัพกันดุเดือด มาดูกันว่าทีมไหนมีโอกาสลุ้นแชมป์มากที่สุด.', 'ณัฐวุฒิ ทดสอบ'),
('พื้นฐาน Git สำหรับมือใหม่', 'Git คือเครื่องมือควบคุมเวอร์ชันที่นักพัฒนาแทบทุกคนต้องใช้ บทความนี้จะอธิบายคำสั่งพื้นฐานและแนวคิดเบื้องหลัง.', 'รัชนีวรรณ ทดสอบ'),
('การใช้ VS Code ให้เต็มประสิทธิภาพ', 'VS Code เป็น IDE ที่มีฟีเจอร์ครบครัน แต่น้อยคนจะใช้ได้เต็มศักยภาพ มาดูเทคนิคและปลั๊กอินที่ควรมี.', 'ธีรภัทร ทดสอบ'),
('AI กับอนาคตของการเขียนโปรแกรม', 'AI เริ่มเข้ามามีบทบาทในการเขียนโค้ด ตั้งแต่การแนะนำบรรทัดต่อไปจนถึงช่วยแก้บั๊ก เราจะมาดูกันว่าอนาคตนักพัฒนาจะเปลี่ยนไปแค่ไหน.', 'จิรายุ ทดสอบ');
