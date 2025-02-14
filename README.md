## Pre-hire Developer Coding Project - Ignacio Giampaoli
## This is a web app built in core/vanilla PHP (no framework) that consumes the provided API to interact with events. Ability to list them, view their details and add new events. 

### Technologies and tools
- PHP as the backend language.
- HTML5/CSS and Bootstrap for the frontend.
- Object Oriented Programming conceps. Use of classes, objects instanciation, inheritance, private and public properties and methods.
- MVC architecture: routing entry point to trigger Controllers-Methods. Communication with the API through models representing the entities. View rendering with retrieved data.
- The detail screen can be reached via a “View details” link present along side every event on the list page.
- Abstaction: Config.php file for API credentials (Base API Url, ClientId and ClientSecret key).
- API Auth via Token using the provided credentials.
- cURL library implementation for handle request and responses in PHP.
- Session Variables ($_SESSION) to avoid the creation of several tokens.

### Requirements
- As a User, you can see the list of all events.
- As a User, you can see the details of an event on a details screen/page (Event Title, Description, Start Date, End Date).
- The detail screen can be reached via a “View details” link present along side every event on the list page.
- As a User, you can add an event to my Calendars/list of events.

### Bonus
- Use of Bootstrap for UI/UX.
- Form validation (mandatory fields, Start Date can't be later than End Date).
- Model-View-Controller architecture (no framework).
- Use of coding standards for a more readable code.
- Use of Git for version control.


### To Do ideas.
- Edit event page.
- Remove event button.
- Sort events by specific field (e.g.: start/end date, title, etc.).
  

## Setting Everything Up
As mentioned above we have chosen to make use of legacy pure PHP as the foundation of this technical test. 
-
