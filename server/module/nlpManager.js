// import pkg from 'node-nlp';
const { NlpManager } = require('node-nlp');
const { addDocuments } = require('./submodule/addDocuments')
const { addAnswers } = require('./submodule/addAnswers')
const fs = require('fs');
const path = require('path');
const modelPath = './model.nlp';

const trainAndProcessNLP = async (question, persons, facilities) => {
  return new Promise(async (resolve, reject) => {
    try {
      const manager = new NlpManager({ languages: ["en"] });
       // Check if the model file exists before trying to load it
       if (fs.existsSync(modelPath)) {
        // Load the pre-trained model
        await manager.load(modelPath);
    } else {
      console.log('its training')
        // Model file does not exist, so train and save the model
        // Add documents and intents using the addDocuments function
        addDocuments(manager, persons, facilities);

        // Add answers using the addAnswers function
        addAnswers(manager);

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
