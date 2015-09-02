# Implementing the Open Supporter Data Interface (OSDI) API for CiviCRM

## Overview

The OSDI API implementation is in line with CiviCRM's mission to be an open platform for organizations of all sizes. Creating the implementation will allow them to use the OSDI API easily. The existence of a common API will reduce progressive data vendors’ customer costs related to moving data between different systems, lower integration costs and enhance the ability of innovators to create products for the marketplace. You can learn more about OSDI at www.opensupporter.org

## Contents:
- [About](https://github.com/anuditverma/org.civicrm.osdi#about-orgcivicrmosdi-extension)
- [Getting Started](https://github.com/anuditverma/org.civicrm.osdi#getting-started)
 - [Installation](https://github.com/anuditverma/org.civicrm.osdi#installation)
 - [Setting up keys](https://github.com/anuditverma/org.civicrm.osdi#setting-up-keys)
 - [Configure the extension](https://github.com/anuditverma/org.civicrm.osdi#configure-the-extension--adding-yoursite-url-and-keys)
 - [Setup Hal-browser (Optional)](https://github.com/anuditverma/org.civicrm.osdi#setup-hal-browser-optional)
- [Usage](https://github.com/anuditverma/org.civicrm.osdi#usage)
- [Updating](https://github.com/anuditverma/org.civicrm.osdi#updating)

## About org.civicrm.osdi Extension

The org.civicrm.osdi extension act as a connecting bridge between two systems one having OSDI implementation and the one using this extension.It can performs GET request to retrieve the people's data from the implemented system based on OSDI specifications. It includes 'Person Sign-up Helper' which is a helper endpoint to aid in the creation of People resources via POST requests. This extension utilizes REST API calls, you can GET the desired data or perform various actions like POST, PUT and DELETE through the REST interface. The rest interface works like the AJAX interface, with one major difference: each call requires an api_key (user key) & key (site key) parameter. And there has to be a user with that api_key having sufficient permissions. We will see how to set these keys within the CiviCRM dashboard and also how to add these keys at various placeholders present within the code. This extension is capable of handling the following actions, let's look up to them briefly:

* GET
-requests are automatically invoked when you want to retrieve the People's data or any individual person's data. You can look up to the desired data through the API explorer on your own CiviCRM site at /civicrm/api (available from the menubar at Help -> Developer -> Api Explorer). Also you can execute a REST call having entity as 'People' and action as 'get' passing along the user key and site key, parameters like options or limits can be added to these REST URI requests.

* POST
-these requests are used to add a new person's record into the system. The 'Person Sign-up Helper' accepts these requests in JSON format having fields' name according to OSDI specification.

* PUT
-This is primarily used to update an existing person's record. You need to provide the 'Method' while using the HAL-browser interface at the person's endpoint whose record has to be updated.

* DELETE
-It deletes the person's record. Similarly, just fill the 'Method' field as 'DELETE' to remove that record.

All these actions can be easily tested on this explorable browser which can be git cloned at your root of the server. [HAL-browser](https://github.com/mikekelly/hal-browser) is an API browser for exploring hal+json type media.
You can also perform these specified actions above through its interface. A NON-GET request can be made through the HAL-browser for executing POST, PUT and DELETE requests.

## Getting Started

### Installation
- Pre-requisite:
 - Assuming you have an up and running CiviCRM site.
 - You need to [enable extensions](http://wiki.civicrm.org/confluence/display/CRMDOC/Extensions) in CiviCRM.
- Next Steps: 
 - Then git-clone this extension : ``` git clone https://github.com/anuditverma/org.civicrm.osdi.git ```
 - On the terminal navigate to sites/all/libraries and install this [Nocarrier\Hal](https://github.com/blongden/hal) library. You can follow the [documentation](https://github.com/blongden/hal#installation) of this library or alternatively just run this command : ``` composer require nocarrier/hal ```

### Setting up keys
You need to set site key and API key before using the REST interface.
- You need to know your site key which can be found in the civicrm.settings.php file labeled CIVICRM_SITE_KEY.
- There are two methods of creating an API key for an individual user.
 - Manual Method : You can enter the key directly in the database table civicrm_contact into the field api_key using your database tool. That would normally be phpmyadmin, MySQL Workbench etc
 - API Key Extension : You can use this extension found [here](https://civicrm.org/extensions/api-key) which would make the whole process much easier.

### Configure the extension -Adding yoursite URL and keys
Now to make this extension work you need to provide your site URL (www.example.com) and the keys which were set in the previous steps.
You need to add these values in the following files. (Helper comments are present in these codes in order to set the values easily)
- [signup.php](https://github.com/anuditverma/org.civicrm.osdi/blob/master/api/v3/signup.php) -Person Sign-up Helper- accepts POST requests to add a new person's record to the system.
- [blank.php](https://github.com/anuditverma/org.civicrm.osdi/blob/master/api/v3/People/blank.php) -eliminates empty fields (under development)
- [index.php](https://github.com/anuditverma/org.civicrm.osdi/blob/master/api/v3/People/index.php) -retrieves (GET) collection of people.
- [person.php](https://github.com/anuditverma/org.civicrm.osdi/blob/master/api/v3/People/person.php) -shows details about individuals and handles PUT & DELETE requests.

### Setup [Hal-browser](https://github.com/mikekelly/hal-browser) (Optional)
- You can git clone the HAl-browser to the site root of your server. ```git clone https://github.com/mikekelly/hal-browser.git```
- To access the HAL-browser just open the 'browser.html' file present in 'hal-browser' directory of your web root.
-In accordance with this you need to use this [CiviCRM-OSDI-Files](https://github.com/anuditverma/CiviCRM-OSDI-Files) repository for adding API Entry Point (AEP) to your server from where you can explore the data of your site and see the working of GET, POST, PUT & DELETE requests in action.
- In order to access the AEP you need to load the osdi.php file into the HAL-browser and then you can explore the other APIs' ends.

## Usage
- Having this extension up and running on your site, you can use HAL-browser to request POST (GET) and NON-GET (POST, PUT & DELETE) requests to your own site. Also you can do the same from your site to an another site where this extension is enabled.
- For exchanging the data between these two said sites, you just need to change the site URLs to the URLs of the target site and also you need to know the API key and SITE key of that target site and then change these values in the code by following these steps mentioned above.
- Follow this [example](https://github.com/anuditverma/org.civicrm.osdi/blob/master/example.md) to know more about NON-GET (POST, PUT & DELETE) requests.

## Updating
To update the extension follow the steps,
- Disable the extension first (Go to Administer -> System Settings -> Manage Extensions)
- Uninstall the extension.
- Then in the extension directory do a ``` git pull ``` via terminal.
- Re-install and enable the extension again.

## See also
- Project discussion thread on the CiviCRM developer's forum [here.](https://forum.civicrm.org/index.php?topic=36374.0)
- Featured introductory [blog post](https://civicrm.org/blogs/anudit-verma/implementing-open-supporter-data-interface-osdi-api-civicrm) on the CiviCRM blog for getting an insight on OSDI and CiviCRM community bonding.
- Final [blog post](https://civicrm.org/blogs/anudit-verma/implementing-the-open-supporter-data-interface-osdi-api-for-civicrm-gsoc) on the CiviCRM blog which includes summary and conclusion of the project.
- Learn more about [OSDI](http://opensupporter.org/) and follow its [documentation.](http://opensupporter.github.io/osdi-docs/)
