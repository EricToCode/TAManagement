# TAManagement
The team members are: Hanyang Eric Chen, Samuel Park, Rudolf Kischer.

The work separation is as follows:
Eric did:
- all features in the orange bubbles, so the TA administration section. 
- all features in the green bubbles, so the Landing/login, Register, connecting to database, dashboard and the Rate a TA section for students.
Samuel did:
- most of the frontend and all the features in yellow, so the sysop tasks.
Rudolf did:
- all the features in blue, so the TA management section for profs and TAs.

Link to website:

https://www.cs.mcgill.ca/~hchen172/TAManagement/FinalProject/landing/landingpage.html


Explanation for TA administration section:

First step import info from the CSV files in the csvs folder with the Import TA Cohort tab.
The TA info & history and Course TA History tab shows information about TAs and the courses.
As an example, I added myself (Eric) as a TA for COMP307 and added 2 ratings (1 & 5), so the average rating is 3.

Explanation for database:

The users table has PRIMARY KEY student_ID, so it prevents the same individual from creating 2 accounts. There's a field containing user type so it can be many roles.

Implementation faults:
Due to our teammate's broken laptop, we ran short on time and could not properly implement the sysop backend.