### Gestion-apprenants (Volunteer Management Solution)
A management solution for learners/volunteer.

## Introduction
This project is a volunteer management solution designed to enable individuals to sign up as volunteers for events in their region. The system includes a public sign-up form, a personal page for volunteers, and an administration panel for managing events and volunteer assignments.

## Installation
1. Clone the repository to your local or production server.
2. Configure your web server to point to the cloned directory.
3. Ensure PHP is installed and properly configured on your server.

## Configuration
Configure the config.php file with your environment settings.

## Features

# Volunteer Form
- Public Registration: Allows users to sign up as volunteers.
- Unique Number: Each volunteer receives a unique number to access their personal space.
- Three-Part Form: Collects personal information, availability and preferences, and a section for free comments.

# Form Operation
- Accessibility: The form is publicly accessible and must be completed sequentially.
- Validation: Each part must be validated before proceeding to the next.
- Submission: After submission and backend validation, a unique code is provided to the volunteer.

# Data Processing
- Frontend Validation: Data is validated before being sent to the backend.
- POST Method: Data is sent to the backend via a POST request.
- Redirection: The user is redirected to a confirmation page with their unique code.

# Volunteer Page
- Access: Volunteers can access their personal space with their password.
- Personal Information: The page displays personal information, registration date, and preferences.
- PHP Sessions: Information is transmitted from the backend to the frontend via PHP sessions.

# Administration Panel
- Secure Login: Access through a username and password.
- Event Creation: Administrators can create events.
- Mission Assignment: Administrators can assign volunteers to events.
- Mission Consultation: Assigned missions are visible to administrators and volunteers in their respective spaces.

## Usage

For Volunteers: Access the public form via the provided URL and follow the instructions to sign up.

For Administrators: Log in to the administration panel with your credentials to manage events and volunteers.

## Authors
- Orhan
- Damien
- Cédric
- Lucas

## Credits & tools used
- Figma: Design tool for creating user interfaces.
- PHPmyAdmin: Web-based tool for managing MySQL databases.
- PHP: Server-side scripting language used for backend development.
- MySQL: Relational database management system.
- HTML: Markup language used for creating web pages.
- CSS: Stylesheet language used for styling web pages.
- Bootstrap: Front-end framework for building responsive websites.
- JavaScript: Programming language used for adding interactivity to web pages.