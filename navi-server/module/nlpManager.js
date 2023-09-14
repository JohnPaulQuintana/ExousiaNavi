// import pkg from 'node-nlp';
const { NlpManager } = require('node-nlp');

const fs = require('fs');
const path = require('path');
const modelPath = path.join(__dirname, 'model.nlp');

const trainAndProcessNLP = async (question) => {
  return new Promise(async (resolve, reject) => {
    try {
      const manager = new NlpManager({ languages: ["en"] });
      // Adds the utterances and intents for the NLP
      manager.addDocument("en", "hello", "greetings.hello");
      manager.addDocument("en", "hi", "greetings.hello");
      manager.addDocument("en", "howdy", "greetings.hello");

      // initial response
      manager.addDocument("en","what is Math","question.ask")
      // continue
      manager.addDocument("en","yes","continue.yes")
      manager.addDocument("en","no","continue.stop")
      
     
      // thanks
      manager.addDocument("en", "thank you","thanks")

      // Train also the NLG
      manager.addAnswer(
        "en",
        "greetings.hello",
        "greetings"
      );
      manager.addAnswer(
        "en",
        "greetings.hello",
        "greetings"
      );
      manager.addAnswer(
        "en",
        "greetings.asking",
        "greetings"
      );

      manager.addAnswer(
        "en","question.ask",
        {
          "answer": "nakapagsalita na ng response, do you want me to continue?",
          "status": 'speaking'
        });

      manager.addAnswer(
        "en","continue.yes",
        {
          'answer':'ituloy mo lang',
          'status':'continue',
        });

      manager.addAnswer(
        "en","continue.stop",
        {
          'answer':'stop na',
          'status':'stop',
        });

      // thanks
      manager.addAnswer(
        "en",
        "thanks",
        "your welcome!"
      );
      manager.addAnswer(
        "en",
        "thanks",
        "Im happy to serve you!"
      );
      manager.addAnswer(
        "en",
        "thanks",
        "have a good day!"
      );
      // Check if a trained model exists
      const modelPath = "./model.nlp";
      const exists = fs.existsSync(modelPath);

      if (exists) {
        // Load the existing model
        await manager.load(modelPath);
      } else {
        // Train the model and save it
        await manager.train();
        await manager.save(modelPath);
      }

      const response = await manager.process("en", question);
      const { intent, score, answer } = response;
      resolve({intent, score, answer});
    } catch (error) {
      console.log(error)
      reject(error);
    }
  });
};

module.exports = {
  trainAndProcessNLP,
};
// export default trainAndProcessNLP
