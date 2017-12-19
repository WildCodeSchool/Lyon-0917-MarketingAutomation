Find and compare a marketing automation software
==================

A Symfony project created by 4 awesomes students in Wild Code School - october 2017 to january 2017.
Here is he manual to use this app. 

1. For user
- Discover all features
2. For project manager
- How can I update my database ? 
- Where can I find list of columns and what data we must find inside ? 

3. For developer

#1. For user

This web application is an amazing tool, very efficient to find softwares for marketing use (specially marketing automation). There are many functionalities :
Find one software by name and consult informations about features, options and have a great quality comment about it;
Find any softwares or software by using search engine. You just have to  write one or many keywords or softwares names to be redirect to result page;
Find softwares by tags. Tags are imagined by site’s owner, to make your search easier with predefined queries. You can access to a list of softwares concerned by this tag;
Compare two softwares by name if you’re really curious about their properties. 

This is a school project. We hope you like using this website !

# 2. Project Manager

As project manager, you may want to update your database, and you’re right ! For you, we imagine a special “moulinette”, very useful. 

##2.1 How do update my database ? 

You can update your database by upload existing files in App/Resources/data. There are 3 files. 

Before trying to update your database :

Keep the names of CSV files already uses;
- Datas must be separated by virgule (,) in CSV file;
- Do not leave characters in empty row (I mean by this : be careful, if there’s something in a cell at the end of the files, the amazing moulinette will never works);
- The Directory (App/Resources/data) require 3 files. If he miss one, the moulinette will not working. Even if you want to update only ONE file, you have to put 3 files, even if 1 or 2 are not updated. Why? Because the wonderful moulinette destroy all the database before to put the new one. 
When your files are ready to update, juste use command console : bin/console import:database and wait for it. 

## 2.2 Where can I find list of columns and what data we must find inside ? 

That’s a really really good question ! We set a special file for you : app/config/import.yml. 
In this file you can find all the datas for each files. You can add column if you want, but before you have to update schema. 

