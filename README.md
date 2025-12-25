# 🧵 Tailors Touch – Online Tailoring & Virtual Try-On System

Tailors Touch is a web-based tailoring platform where users can select dress types, upload measurements, and visualize how the outfit looks on their body before stitching. The system includes **Virtual Try-On**, **GPS-based location saving**, **Order management**, and **Feedback Summarization using NLP**.

---

## 📌 Project Explanation

This application digitizes tailoring services and offers a smooth workflow like an online shopping system but for custom stitching.

### 👩‍💻 User Flow
1. Select dress type → Material → Color
2. Enter body measurements (dynamic fields based on dress type)
3. Capture/Upload image for **Virtual Try-On preview**
4. System overlays dress image on user's body using BodyPix / OpenCV.js
5. Save location + book home visit or pick-up
6. Place order → Admin updates progress until delivery
7. Provide feedback → System summarizes reviews (NLP Summarization)

---

## 🎯 Key Features

✔ Trend & Material Selection (Dynamic UI)  
✔ Measurement Form Auto-Changes Based on Dress Type  
✔ **Virtual Try-On System** using BodyPix + OpenCV.js  
✔ Background removal & body alignment for dress overlay   
✔ Home Visit / Pickup Scheduling  
✔ Order Status Tracking  
✔ **Feedback Summarization** using NLP (Python / TextRank)  

---

## 🎥 Virtual Try-On System

The virtual try-on module allows the user to preview how the outfit fits.

**Working:**
- Upload image or open camera
- Background removed using BodyPix
- Dress overlay placed on body coordinates
- Scale & transformation applied to fit proportions

**Tech used:**
- TensorFlow.js BodyPix
- OpenCV.js for alignment & transformation
- CSS/Image overlay for frontend preview

---

## 💬 Feedback Summarization

Users submit reviews after order delivery.  
The system performs **text summarization** on collected feedback to generate:
- Most common issues
- Quality rating patterns
- Areas of improvement

**Tech used:**
- Python NLP (TextRank / NLTK)
- Keyword Extraction
- Summary Generation

---

## 🛠️ Tech Stack Used

| Component | Technology |
|----------|-------------|
| Frontend | HTML, CSS, JavaScript, Bootstrap |
| Backend | PHP |
| Try-On Processing | BodyPix (TensorFlow.js), OpenCV.js |
| Database | MySQL |
| Feedback Summarization | Python + NLP (TextRank/Spacy/NTLK) |
| Tools | XAMPP, VS Code, MySQL Workbench |

---


---

## ⚙️ How to Run the Project

1️⃣ Setup Environment
- Install XAMPP
- Start Apache & MySQL

2️⃣ Clone the Project
git clone https://github.com/yourusername/TailorsTouch.git
cd TailorsTouch

3️⃣ Move Project to Server
C:/xampp/htdocs/TailorsTouch

4️⃣ Import Database
1. Open phpMyAdmin
2. Create a new database named: tailors_touch
3. Import the file: tailors_touch.sql

5️⃣ Run on Localhost
http://localhost/TailorsTouch/index.php


