## Requirements

* `composer`
* `PHP >=7.1`


## Setup

1. Open `composer.json` and define all the information
2. run `npm start` to set up the files
3. run `npm run build` to build the files for production which will be found in `/dist/` folder
4. `gulp-local-tasks.js` relates to each developer for defining **local** gulp tasks and running them by command `gulp localTasks`, therefor it must be added in `.gitignore` file


## Notes

* use namespace to encapsulate your PHP code
* use comments to describe your code
* think modularly, extendable, and optimized as possible