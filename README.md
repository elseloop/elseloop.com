## Elseloop.com
### version 4? 5? Something like that...

#### The general idea
Build out a new site to address immediate needs. Namely, 1) a place to blog about my work in the front-end and related topics I find intriguing, 2) learn some new skills along the way while adhering to best practices, and 3) do everything out in the open, in small steps, as quickly as possible.

To begin, use WordPress for the back-end and Ember.js for the front-end. Build incrementally, getting up an MVP version -- blog feed + single view -- as quickly as possible. Loop back and add new features afterward as needed and time permits, starting with rounding out CRUD features on the front-end...

#### The initial plan
1. Local install setup
  * ~~wp skeleton~~
  * ~~fresh git repo~~
  * ~~db~~
  * ~~install WP JSON REST API plugin~~
    * ~~write some dummy posts to test API payload(s) against~~
2. Theme Setup
  * turn off default WP templating
  * get EmberJS going in theme directory
    * init app()
    * test default route is working
3. Plan out necessary routes in Ember
  * home (/)
    * list of 10 most recent posts
      * title, link, date, 1-sentence excerpt/summary
  * single view (/post/:slug/)
    * post content (body text, meta data, images/embeds)
    * next/previous navigation
    * link home
4. Ensure routes are working
5. Set up front-end
  * Grunt setup (or maybe Gulp? Probably Gulp.)
  * initial Sass structure
  * base styles
6. Get styling
  * header
  * footer
  * homepage list
  * single body content
  * single meta data
  * images/embed handling in single view
  * single next/prev nav bar
7. Get up on live server
  * setup new server?
  * backup current site files/db
  * replace db
  * deploy with Capistrano?
  * keep compiled CSS out of repo, compiling on post-deploy hook?
8. Get blogging!

#### The intended future
1. About page
2. Front-end edit & new post handling (Ember Data layer?)
3. Rebuild portfolio
4. Swap out the WP backend for Rails backend?
5. whatever else arises?