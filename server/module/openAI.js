const dotenv = require("dotenv");
const { Configuration, OpenAIApi } = require("openai");


dotenv.config();
const configuration = new Configuration({
  apiKey: process.env.OPENAI_API_KEY,
});

const openai = new OpenAIApi(configuration);

 const translateText = (separatedText, question) => {
  return new Promise((resolve, reject) => {
    openai
      .createCompletion({
        model: "text-davinci-003",
        prompt: `read this all as a professional reader : ${separatedText} that data is the answer for this question: ${question}`,
        temperature: 0.9,
        max_tokens: 255,
        top_p: 1.0,
        frequency_penalty: 0.5,
        presence_penalty: 0.0,
      })
      .then((res) => {
        const answer = res.data.choices[0].text;
        resolve(answer);
      })
      .catch((error) => {
        reject(error);
      });
  });
};

module.exports = {
  translateText,
};

// export default translateText;