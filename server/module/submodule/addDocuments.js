const facilitiesModule = require('./partsModule/facilities')
const greetingsModule = require('./partsModule/greetings')
const personsModule = require('./partsModule/persons')
const thanksModule = require('./partsModule/thanks')
const personLocationModule = require('./partsModule/personLocation')

const addDocuments = (manager, person, facilities) => {
    const facilitiesArray = facilities; 
    const persons = person; 

    // greetings
    greetingsModule(manager);
    
    // facilities module
    facilitiesModule(manager, facilitiesArray);

    // person module
    personsModule(manager, persons);
   
    // person location module
    // personLocationModule(manager, persons)
    // thanks module
    thanksModule(manager);

    
   
};

module.exports = {
    addDocuments,
};