# BW 2024 Quiz

A **Native PHP & MySQL Web Application** for taking quizzes with Google Authentication and summary statistics of users' results. This project was developed for the **Beginning Well 2024** event.

---

## Features
- User authentication via Google OAuth.
- Quiz-taking functionality.
- Summary statistics of user results.

---

## Requirements
1. PHP (with Apache server)
2. MySQL database

---

## Set Up

Follow these steps to set up the application:

1. **Start Required Services**  
   Ensure your Apache server and MySQL database are running.

2. **Database Configuration**  
   - Create a new database named `quiz`.
   - Import the `quiz.sql` file into the database.  
     ```
     mysql -u <username> -p quiz < quiz.sql
     ```

3. **Configure Google OAuth Redirect**  
   - Locate the `google-oauth.php` file in your project directory.  
   - Update the `$google_redirect_url` variable in your PHP code to the appropriate directory where `google-oauth.php` is hosted. Example:
     ```php
     $google_oauth_redirect_uri = 'http://localhost/bw-24/google-oauth.php';
     ```
4. **Run the Application**  
   Open the application in your browser at `http://localhost/<your-directory>`.

---

## Usage

1. Authenticate using your Google account.
2. Take the quiz and submit your answers.
3. View a detailed summary of your results, including statistics.

---

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a feature branch:  
   ```
   git checkout -b feature/<feature-name>
   ```
3. Commit your changes:  
   ```
   git commit -m "Add <feature-description>"
   ```
4. Push to the branch:  
   ```
   git push origin feature/<feature-name>
   ```
5. Open a pull request for review.

For major changes, please open an issue first to discuss your proposal.