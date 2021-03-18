## Company Listing Application

### Tech Stack
- Laravel 8 Backend
- Vue Frontend with Inertia
- SQLite

### Requirements
|   |Requirement       |Notes                            |
|---|:------------------|:---------------------------------|
|[]|An Admin User should be able add a company.|The frontend must be completed for this as well as CompanyController@store.|
|[]|An Admin User should be able to edit a company.|The frontend must be completed for this as well as CompanyController@update.|
|[]|Logged in users should be able to rate a company.|There is a frontend component where companies can be rated, but the endpoint and backend needs to be created for it.|
|[]|The CompanyResource should return the average rating, rating count, and rating of the logged in user (if it exists).|The frontend's rating component will utilise this.|
|[]|A user should be able to filter the list by the company name, minimum rating, and maximum rating.|Both the frontend and CompanyController@index method need to be updated for this|
|[]|A public api endpoint should allows access to all companies with their rating and rating count| |

### Evaluation Criteria
- Readability and consistency of newly introduced code.
- Comprehensive unit testing coverage
- Consideration of edge cases
- Use of Laravel best practices and design patterns
- Atomic git commit history with helpful messages

### Bonus Points
- Take a look around the application and look for areas that 
you think could be improved upon. Just add a TODO and suggest
some refactors which will improve the maintainability or
readability of the project, or prevent any unexpected behavior.
