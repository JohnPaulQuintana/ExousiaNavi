module.exports = function addPersons(manager, persons) {
    persons.forEach((person) => {
        manager.addDocument("en", `Who is ${person}?`, 'query.persons');
        manager.addDocument("en", `Tell me about ${person}.`, 'query.persons');
        manager.addDocument("en", `What can you tell me about ${person}?`, 'query.persons');
        manager.addDocument("en", `Give me information on ${person}.`, 'query.persons');
        manager.addDocument("en", `Can you provide details about ${person}?`, 'query.persons');
        manager.addDocument("en", `Do you have any information on ${person}?`, 'query.persons');
        manager.addDocument("en", `How can you describe ${person}?`, 'query.persons');
        manager.addDocument("en", `Tell me more about ${person}.`, 'query.persons');
        manager.addDocument("en", `What do you know about ${person}?`, 'query.persons');
        manager.addDocument("en", `Give me details about ${person}.`, 'query.persons');

        // Add 10 more variations for querying the principal at Eastwoods within the "query.persons" intent
        manager.addDocument("en", `Who is the principal at Eastwoods?`, 'query.persons.position');
        manager.addDocument("en", `Tell me about the principal at Eastwoods.`, 'query.persons.position');
        manager.addDocument("en", `What is the name of the principal at Eastwoods?`, 'query.persons.position');
        manager.addDocument("en", `Give me details about the principal at Eastwoods.`, 'query.persons.position');
        manager.addDocument("en", `Can you provide information on the principal at Eastwoods?`, 'query.persons.position');
        manager.addDocument("en", `Do you know who the principal is at Eastwoods?`, 'query.persons.position');
        manager.addDocument("en", `Describe the principal at Eastwoods.`, 'query.persons.position');
        manager.addDocument("en", `Tell me more about the principal at Eastwoods.`, 'query.persons.position');
        manager.addDocument("en", `What is the role of the principal at Eastwoods?`, 'query.persons.position');
        manager.addDocument("en", `Provide information on the principal at Eastwoods.`, 'query.persons.position');

        // manager.addDocument("en", `What is ${person}'s position at Eastwoods?`, 'query.persons');
        // manager.addDocument("en", `Tell me about ${person}'s role at Eastwoods.`, 'query.persons');
        // manager.addDocument("en", `What does ${person} do at Eastwoods?`, 'query.persons');
        // manager.addDocument("en", `Give me details about ${person}'s job at Eastwoods.`, 'query.persons');
        // manager.addDocument("en", `Can you provide information on ${person}'s position at Eastwoods?`, 'query.persons');
        // manager.addDocument("en", `Do you know what ${person}'s title is at Eastwoods?`, 'query.persons');
        // manager.addDocument("en", `Describe ${person}'s role at Eastwoods.`, 'query.persons');
        // manager.addDocument("en", `Tell me more about ${person}'s position at Eastwoods.`, 'query.persons');
        // manager.addDocument("en", `What is ${person}'s job title at Eastwoods?`, 'query.persons');
        // manager.addDocument("en", `Provide information on ${person}'s role at Eastwoods.`, 'query.persons');

    })
}