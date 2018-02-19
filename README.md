Find and compare a marketing automation software
==================

A Symfony project for the website [comparer.pro](http://comparer.pro) created by 4 awesome students in the [Wild Code School](https://wildcodeschool.fr/) - october 2017 to january 2018!
Here, the manual to use this app:

- [For user](#for-user)
- [For Project Manager](#for-project-manager)
    - [How can I update my database?](#how-to-update-my-database)
    - [I have a doubt in the cell format. Where can I find list of columns and what data must I write inside?](#i-have-a-doubt-in-the-cell-format-where-can-i-find-list-of-columns-and-what-data-must-i-write-inside)
    - [Some legitimate words do not find any softwares in research bar, how can I upgrade that?](#some-legitimate-words-do-not-find-any-softwares-in-research-bar-how-can-i-upgrade-that)
    - [I want to add a column to the file. How may I proceed?](#i-want-to-add-a-column-to-the-file-how-may-i-proceed)
- [For Developper](#for-developper)
    - [How can I deploy the website? What do I need?](#how-can-i-deploy-the-website-what-do-i-need)
    - [What are all these properties in the database and what are the difference between them and tags?](#what-are-all-these-properties-in-the-database-and-what-are-the-difference-between-them-and-tags)
    - [How can I add a new property in my database?](#how-can-i-add-a-new-property-in-my-database)
    - [How the “moulinette” works? What is the purpose of the “see also” entity?](#how-the-moulinette-works-what-is-the-purpose-of-the-see-also-entity)
    - [How the awesomeSearch’s algorithm works?](#how-the-awesomesearchs-algorithm-works)
    - [How the “filters” in view’s result works?](#how-the-filters-in-views-result-works)
    - [How add new synonyms](#how-add-new-synonyms)
- [Installing or renewing a let's encrypt OVH certificate on a VPS](#installing-or-renewing-a-lets-encrypt-ovh-certificate-on-a-vps)
    - [Install an SSL certificate](#install-an-ssl-certificate)
    - [Renew an SSL certificate](#install-an-ssl-certificate)
- [Creators](#creators)

## For user

This web application is an amazing tool, very efficient to find softwares for marketing use (especially marketing automation). There are many functionalities :

- Find one software by name and consult informations about features, options and have a great quality comment about it;
- Find any software by using search engine. You just have to write one or more keywords or software’s name to be redirect to the results page;
- Find softwares by tags. Tags are imagined by site’s owner, to make your search easier with predefined queries. You can access to a list of softwares concerned per tag;
- Compare two softwares by name if you’re really curious about their properties.

This is a student’s project. We hope you’ll like using this website!

## For Project Manager

As a project manager, you may want to update your database, and you’re right! For you, we imagined a special “moulinette”, very useful.

### How to update my database?

You can update your database by upload existing files in App/Resources/data repository. There are 3 files (.csv).

Before trying to update your database :

- Keep the names of CSV files already used: (import-softwares.csv / import-tags.csv / import-versus.csv)
- Datas must be separated by a comma (,) in CSV file; (In import-softwares.csv, to separate Tags separate them with ‘#’ between tags. If not, it will not be split)
- The Directory (*App/Resources/datas*) require the 3 files. If one is missing, the moulinette will not work. Even if you want to update only ONE file, you have to put 3 files, even if 1 or 2 are not updated. Why? Because the wonderful moulinette destroys all the database before to put the new one.
- Only rows with “ok” in the first column will be imported. It allows you to keep information in your csv without publish them on your website. 
- If you attribute a tag to a software, make sure this tag exists in import-tags.csv. if not, create it.
- To display the logo of a new software you added. You must save you image in the folder: *web/assets/img/logo* and rename it with its slugged name “.png” (the slugged name correspond to the name of the software in lowercase, without accent and spaces replaced by “-”. For example the logo for the software “Dêce Pacitô” will be dece-pacito.png) 
- When your files are ready to update, juste use command console : `bin/console import:database` and wait for it.

### I have a doubt in the cell format. Where can I find list of columns and what data must I write inside?

That’s a really really good question ! We set a special file for you : *app/config/import.yml*.
In this file you can find all the datas for each files.

### Some legitimate words do not find any softwares in research bar, how can I upgrade that?

The research algorithme works with correspondence between the tippen words and the content of each softwares in the database. A part of this correspondence comes from all the text in the database. The other comes from a “synonym file”, this is where you can add content that can be recognize when someone write in the research bar. The file path is  “app/config/awesomeSearch.yml”. There you can add synonyms to properties to allow a more complete and accurate research. For each property there is a lyne “Synonymous:” you can add any words you want to this line separated by spaces. Make sure of the accuracy of the words you add: it has a powerful impact on the results of the research.

### I want to add a column to the file. How may I proceed?
You can’t just add a column where you want. Refer to the developer section for more informations.

## For Developper

The website development is not perfect. This section will help you to understand it and upgrade-it if you desire.

### How can I deploy the website? What do I need?
- This website is a Symfony project using PostGresql, PHP 7.2.1 (**avoid 7.2.2**, because there’s an issue when using “moulinette”), Apache and other regular settings (such as composer and doctrine).  
- Use Git to clone repository, 
- Use this commands after set database name in parameters.yml :

    `composer install`

    `bin/console doctrine:database:create`

    `bin/console doctrine:schema:validate`

    `bin/console doctrine:schema:update --force`
- Store images : *web/assets/img/logo*

### What are all these properties in the database and what are the difference between them and tags?

In a “front point of view”, tags and booleans properties are treated the same way (as tags), you can see all of them together on the listing software view. In a “back point of view”, each booleans properties are converted with the boolAstags service.

### How can I add a new property in my database?

To proceed you have to follow these different steps:

- Chose the Entity where you want to add a property.
- Modify the file: *app/config/import.yml* (in the file you want to add it, in the good entity, in the fields list, add the name and the type of your property (ie: “myProperty: boolean”) 
- Add your column in your csv file AT THE EXACT SAME POSITION than in your YML file you just modified. (ie: if you added “myProperty: string” just after “webSite: string” in your YML file, make sure it is also after website in your csv file) 
- If it’s a boolean, modify the file: *app/config/awesomeSearch.yml*, add the property in the good entity at the good position. Complete its Name, Slug, Description and Synonymous field. Refer to other properties to understand how to fill these fields. (the “name” is the way it will be displayed on views, the slug will be used for the url generation, the description  will be displayed on the Tag view. For the role of “synonymous” refer to section [How can I update my database?](#how-to-update-my-database)
- Modify the target entity in *src/AppBundle/Entity* by adding the new property. Do no forget getters and setters
- Update the schema (with doctrine: `bin/console doctrine:schema:update --force`)
- Re-import your database (`bin/console import:database`)
- Your Database is updated. If you want to display your new property in a a table or anywhere else, don’t forget to modify your views. If it is a boolean, it will be automatically added where tags are presents. If this is a string, its content has to be manually displayed and is not take into account in the awesomeSearch service. 

### How the “moulinette” works? What is the purpose of the “see also” entity?

“Moulinette” import each lines of csv file (if there’s “ok” in the first case of each row), using yapp/config/import.yml file (see [How can I add a new property in my database?](#how-can-i-add-a-new-property-in-my-database)). Moulinette is just a dumb service, who follow instructions given by yml file : relations, entities, type of column (integer, boolean, text …). 
When using bin/console import:database, there are different actions:

- Verify if the csv files are 3, 
- Verify if the csv files have as much as columns as specify in yml file,
- In case there are no errors, moulinette imports datas,
- After import datas, it’s time to calculate “Software to see also”, using Awesome Search (looking for the 6 most-alike softwares and store it in entity to be more efficient when it’s display,
- List of “booleans as tags” are store too, using service “booleans as tags”.
End of transaction if all is going well. 

### How the awesomeSearch’s algorithm works?

AwesomeSearch’s goal is to give to users a list of most relevants softwares. Awesome Search Service receive a request, and this is what happen next :

- Clean query : delete words of two letters, delete empty words (list is in awesomeSearch.yml),
- For each word, look if it’s in any field of software or in synonyms of each properties in awesomeSearch.yml (see [How add new synonyms](#how-add-new-synonyms)),
- According to his number off occurrence and position in database, we add points (for example more points are given if the word is in title). 
- Merge each results for each softwares, 
- Give an array of softwares, order by relevance.

### How the “filters” in view’s result works?

Action on controller respond a json file, used in result page to filter results. Each checkbox is linked to one property of softwares, so the filters function gives a filtered list of softwares. 
This parts use VueJS technology but with no components. 

### How add new synonyms

The awesomeSearch.yml is a kind of database’s description and also a dictionary. Yaml helps the Project Manager to update this dictionary, no need to change schema or database. 

For each boolean property of each entity (except tags and versus):

- Entity’s name, 
- List of properties, and for each:
- Name -> display in front (see [What are all these properties in the database and what are the difference between them and tags?](#what-are-all-these-properties-in-the-database-and-what-are-the-difference-between-them-and-tags))
- Slug -> display in front (for urls, see [What are all these properties in the database and what are the difference between them and tags?](#what-are-all-these-properties-in-the-database-and-what-are-the-difference-between-them-and-tags))
- Description  -> display in front (see [What are all these properties in the database and what are the difference between them and tags?](#what-are-all-these-properties-in-the-database-and-what-are-the-difference-between-them-and-tags))
- Synonym -> use in awesomeSearch service (see [How the awesomeSearch algorithm works?](#how-the-awesomesearchs-algorithm-works))
To add new synonyms: 
- Choice the good properties, add words into the good lines “synonyms”
- If the property not exist:
- Add in entity (using notes),
- Update schema,
- Add property’s name in the list of related entity,
- Repeat 4 fields (description, name, slug, synonymous).

### About Internationalization

Why we did this?

In the Software and Comparison pages you can see tables. Each table correspond to an Entity created and each entity has properties. We wanted to centralize each properties in the same file to evitate

And another good thing; in the future if the website’s owner wants to translate in english or another language he can already do that because it’s already configured.

In the repository *app/config/* in config.yml we added => translator: { fallbacks [‘%locale%’] }.
We needed a dictionary. So in the Resources we created a field named *translations* and into this, a file named ‘messages.fr.yml’. 
We used the ‘trans’ block to mark parts in the template as translatable.

## Installing or renewing a let's encrypt OVH certificate on a VPS

### Install an SSL certificate

First, go to the root folder with command: 

`cd /`

To get the ssl certificate, we will use automated commands that will directly look for it on the GitHub library. Enter the following command to download Let's Encrypt:

`git clone https://github.com/letsencrypt/letsencrypt`

It is important that Let's Encrypt is installed at the root of the server, then it can identify your different managed domains on the VPS.

Go to Let's Encrypt folder and enter the following command:

`./letsencrypt-auto`

The rest of the configuration will simply ask you to confirm the installation of the certificates or to confirm their renewal if another certificate is detected.

Once this action is done, your SSL Let's Encrypt certificates are configured and ready to host in HTTPS world.

### Renew an SSL certificate

SSL certificates have a validity period to allow a better security of your sites. Once the validity is complete, you will have to renew it.

Go to Let's Encrypt folder and enter the following command:

`./letsencrypt-auto renew`

Certificates to be renewed will be detected and you will only need to confirm the action.

## Creators

**Anne-Laure De Boissieu** - <https://github.com/al2b>

**Fanny Perret** - <https://github.com/fannyperret>

**Andy Razanamazava** - <https://github.com/AR6A>

**Pierrick Reux** - <https://github.com/pireux>

### Contributor

**Pierre Ammelot** - <http://pierre.ammeloot.fr/>
