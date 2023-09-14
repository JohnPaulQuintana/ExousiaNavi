// addAnswers.js
const addAnswers = (manager) => {
    // Add answers for greetings, hymn-related questions, and thanks
    manager.addAnswer("en", "greetings.hello", "Hey there! How can I help you?");
    manager.addAnswer("en", "greetings.hello", "Greetings! What can I do for you?");
    manager.addAnswer("en", "greetings.asking", "Hello there! What can I do for you?");
    manager.addAnswer("en", "greetings.asking", "Yes, how can I assist you?");
    
    // facilties
    manager.addAnswer("en","query.facilities","would you like me to give you a map?")
    
    manager.addAnswer("en","query.facilities.show","ofcourse!, here is the map with navigation attach to it!. is there anything i can do for you?")

    // persons
    // manager.addAnswer("en","query.persons","yeah!, sure, based on my data's!")
    manager.addAnswer("en","query.persons","yeah!, sure.!")
    manager.addAnswer("en","query.persons.position","yeah!, sure.!")
    // problem in here
    // manager.addAnswer("en","query.persons.facilities.show","ofcourse!, here is the map with navigation attach to it!")

    // thanks
    manager.addAnswer("en", "thanks", "your welcome!");
    manager.addAnswer("en", "thanks","Im happy to serve you!");
    manager.addAnswer("en", "thanks", "have a good day!");
};

module.exports = {
    addAnswers,
};