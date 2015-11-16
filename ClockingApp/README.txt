README

This app will automatically clock in employees in work based on their GPS location.  

Admin Username: admin
Admin Password: admin

User password: jmurdock
User username: jmurdock


To Test the GPS functionallity, an app will need to be installed to be able to spoof GPS coordinates

Admins have different options than regular users.  Administrators can set schedules for users and also change the address of work.  The address of work is what establishes where the users will be clocked into based on their gps locations.  After a GPS location has been set, there will be a bounding box created by the API.  This bounding box will be sent to employees phones when the log into the program.  These for corners of the bounding box are checked against when the phone is moved.  If the phone is inside of the bounding box, it will alert the API that the user is inside the bounding box.  This will automatically clock the user into work.

Other functions, such as viewing schedule and hours worked are self explanatory.

The Lunch clock in/out will allow the employee to clock out for lunch even if they are on site.  They may also clock in from lunch when they are onsite and clocked out.