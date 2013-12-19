p4.harvardyan.biz
=================

Project4

My application is called Netchat. In addition to keeping all the features done in P2, I add some new features into this application.

Netchat's 'basic' features:

Add posts
View posts
Follow people
Welcome letter
Uploade images

Netchat's 'New' features:

Online chat
Gamerecord
"Guess my number" game

People can chat with other users on the "Online chat" webpage.
The game "Guess my number" is my P3. Other than the practice version and score mode I developed last time, I added one more version: timemode. People need to guess the correct number in 5 minutes.
To make it more fun, I created a database, called "gamerecord". It will record every user's highest score and fastest time in "guess my number" game. Everytime the user breaks their own records, the system will say "congraulations" and provides the link for him/her to post this news to share with others.
I also created a gamerecord page. People can check their own record of highest score and fastest time in "guess my number" game, as well as the records in Netchat from all the users.

These three new features are heavily done in JS. The "adding post" effect is done by Ajax, and the code is from the class.

About database:
	I added one column in the "users" table. It's called "chatroom". When the user is on the "online chat" webpage, it is set as 1. Otherwise, it is set as 0 (when they are on other webpages or logged out). That's how I get the list of all the users on that particular webpage. I guess there will definitely be smarter ways to do the same thing, but at least it works.
 	I created the "gamerecord" table to record every user's own record of highest score and fastest time in "guess my number" game, as well as the time when they set the record.