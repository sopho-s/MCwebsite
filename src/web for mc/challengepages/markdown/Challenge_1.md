In this monthly challenge I developed a website to store all my monthly challenges/

The main motives to do this was:/

*Develop my problem solving and research skills, as I haven't used html properly (without copying and pasting)

*Develop as a programmer (even though making websites is not really programming imo)

*Practice html for my exams

*Have a place to store the work that I do and my process of making them

The main objectives it to not copy large sections of html directly, I will still be using resources as I have no idea what I am doing most of the time. The website will contain the blog of each challenge, the source code of the final products, and info about the program selected/

At the start while tried to keep the website to its bare bones I did have to add some styling to get a better idea of how I would format the website at a later date/

![](homepage1.png)

![](challengepage1.png)

I made it look a bit nicer the plain text I had seen another blogging website and saw that they seperated their text from their page with this box, which I kind of liked so I made a div to contain all the text and images in an outset box/

Next I implemented the source code link at the bottom of the page, so that when you click you go to the source code page and see the version history, currently just going to use a list to display all of the versions but id like to improve upon this/

![](challengepage2.png)

![](sourcecodepage1.png)

I will probably make it so that it displays more info about each file, like size upload time and other things, but first I thought I'd upgrade the main page/

![](homepage2.png)

I decided to do the same as I did for the blog part and split them by sections, they'll each have a thumbnail, a title, and a quick description/

I had originally made the source code hard coded into the webpage, so I would have to add a new list each time I upload more files. I thought it would be better to implement some JavaScript to read the files, this would also allow me to get all the info about each of the files/

To fix this first I implemented some php to perform all the file handling/

![](sourcecodepage2.png)

At this point I decided to restructure the website to make it more organised and make my job of improving it a lot easier later on/

I also realised from a security standpoint its stupid to allow people to upload whatever they want to the website (even though this is just for me) so I decided to only focus on the file upload for a bit/

I decided to use a SQL server to store login info to allow users to edit the website/

![](uploadpage1.png)

This quick page allows the user to enter a user and password before being able to submit a file/

![](phpmyadmin1.png)

I then made a user and password in the mysql database and used these for all of testing/

o improve this next I thought I'd make a login page that would allow you to login and then access all the features (which are limited currently) throughout the website/

![](loginpage1.png)

![](userpage1.png)

I also allowed the user to upload photos to the photo file so that when I create page editing they can add photos without having to change the page directly/

This website also uses cookies so I am going to have to make a way to make sure the user confirms to using cookies before I use them, as if I actually upload this website I have to abide by the GDPR/

![](cookies.png)

Now whenever the user enters the website they will be asked to accept cookies, if they accept they will be given a cookie that shows that they accepted cookies, I will need to make it so that it stops asking if they don't accept but I'll add that later/

I decided my next priority was allowing users to edit pages (if they have the privileges to do so) directly from the webpage. Doing this should make it easier to create more pages in the future/

To do this I will store each page as a markdown file which will be used to produce the page, I'll be making this myself from scratch/

![](Editor1.png)

This currently does not support all markdown functionalities and only supports normal paragraphs, unordered lists and images/

I now need to make it so only users who have logged in and have the privileges can access the editor/

![](Editor2.png)

![](Editor3.png)

This now stops showing the user the edit icon if they don't have the permission to do so/

![](Editor4.png)

![](Editor5.png)

It also stops users from submitting the file by accessing the edit form page directly by showing them a 401 or a 403 error/

It is also a bit tedious removing the cookies and the session ID and then logging back in again to switch between users, so I will make a quick log out system (this would have needed to be implemented anyway)/

![](logout.png)

This just makes debugging a lot easier now (as I am currently running close to the deadline)/

As I'm getting close to my deadline of the end of the month (I'll still do improvements beyond this but I want the main features done and dusted this month) I'll add the ability to add new pages that can then be edited/

This does mean I'm going to need to dynamically create and load pages/

![](newpage1.png)

![](newpage2.png)

![](newpage3.png)

This now allows me to enter a few details in and then it will generate a new page and add it to the index.html page which allows me to access it/