const natural = require('natural');
const nlp = require('compromise');
// import pkg from 'natural';
// const { natural } = pkg;
// import natural from 'natural';
const tokenizer = new natural.WordTokenizer();
const { establishConnectionAndFetchSchema } = require('./dbConnection.js');
const promises = [];
// const dataMatched = [];
const extractKeywords = async(question)=> {
  const doc = nlp(question);

  // Extract keywords (nouns and adjectives)
  const keywords = doc.nouns().out('array').concat(doc.adjectives().out('array'));
  console.log(keywords.map((keyword=>keyword.replace(/[^a-zA-Z0-9\s]/g, ''))))
  // test using compromize
  const tokens = keywords.map((keyword=>keyword.replace(/[^a-zA-Z0-9\s]/g, '')));
  // Identify and separate phrases enclosed in quotes as individual keywords
  const processedKeywords = [];
  const delimiter = ' '; // Specify the custom delimiter
  tokens.forEach((keyword) => {
    const phraseKeywords = keyword.split(new RegExp(delimiter, 'i')); // Use a regular expression with 'i' flag for case-insensitive matching
    processedKeywords.push(...phraseKeywords);
  });
  // orginal
  // const tokens = tokenizer.tokenize(question);
  const currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  const stopwords = natural.stopwords;
  const customWords = ['sir', 'ma\'am', 'location', 'eastwoods', 'professor', 'find', 'located'];
  console.log(processedKeywords)
  const filteredTokens = processedKeywords.filter(token => !stopwords.includes(token.toLowerCase()) && !customWords.includes(token.toLowerCase()));

  const keywordsObject = {};
 

  filteredTokens.forEach((token, k) => {
    if (token.toLowerCase() === 'today') {
      keywordsObject['k'] = currentTime;
    } else {
      const promise = findKeywordInDB(token)
        .then((result) => {
          if (result) {
            const { record, data, filterFields } = result;
            // console.log(data)
            const match = findMatchInData(record.tableName, data, filterFields, token.toLowerCase());
            if (match) {
              keywordsObject['t'] = record.tableName;//table name
              keywordsObject['k'] = token.toLowerCase();//keywords
              
              keywordsObject['data']= match;;//match
              keywordsObject[token] = match; // Use the token as the key to store the specific row
            } else {
              keywordsObject['k'] = token.toLowerCase();
            }
            // if(match){
            //   keywordsObject[token] = match; // Use the token as the key to store the specific row
            // }
          } else {
            keywordsObject['k'] = token;
          }
        })
        .catch((error) => {
          console.error(error);
        });

      promises.push(promise);
    }
  });

  return Promise.all(promises)
    .then(() => {
      return keywordsObject;
    })
    .catch((error) => {
      console.error(error);
    });
}

function findKeywordInDB(token) {
  return new Promise((resolve, reject) => {
    establishConnectionAndFetchSchema()
      .then((result) => {
        const { data, schema } = result;
        // console.log(data)
          // Generate filterFields based on the schema
          const filterFields = [];
          for (const tableName in schema) {
            const tableColumns = schema[tableName]; // all the columns in tables
            for (const column of tableColumns) {
              const columnName = column.columnName; // all the columns name in tables
              // console.log(columnName) //
              // removes the columns
              if (!['id','hymn', 'vision', 'mission'].includes(columnName)) {
                filterFields.push({
                  name: columnName,
                  value: token
                });
              }
            }
          }
        
          // this is responsible for match making words on columns and data
        for (const record of data) {
          // console.log(record.data)
          for (const row of record.data) {
            // console.log(row)
            const keys = Object.keys(row);
            // console.log(keys)
            for (const key of keys) {
              const value = String(row[key]);
              // console.log("Token: "+token)
              // console.log("KEY : "+key)

              // they check for keys and value in db schema pay attention on the keys written on a values because its going to be true
              if (key.toLowerCase().includes(token.toLowerCase()) || value.toLowerCase().includes(token.toLowerCase())) {
               console.log('Value : '+value+" = "+"token : "+token)
                resolve({record, data, filterFields});
                return;
              }
            }
          }
        }
        resolve(null);
      })
      .catch((error) => {
        reject(error);
      });
  });
}

function findMatchInData(tableName, data, filterFields, token) {
  console.log(data)
  return new Promise((resolve, reject) => {
    const dataMatched = [];

    const match = data.find(item => item.tableName === tableName);
    // console.log(match)
    if (match) {
      match.data.forEach(row => {
        const isMatch = filterFields.some(({ name, value }) => {
          const rowValue = row[name];
          // console.log(rowValue)
          return rowValue && String(rowValue).toLowerCase() === value.toLowerCase();
        });

        if (isMatch) {
          const filteredRow = Object.keys(row).reduce((obj, key) => {
            if (!['hymn', 'vision', 'mission'].includes(key) &&
              filterFields.some(({ name, value }) => name === key && String(row[key]).toLowerCase() === value.toLowerCase())) {
              obj[key] = row[key];
            }
            // console.log(obj)
            return obj;
          }, {});
          dataMatched.push(row);
          // i have a problem in here for vision n mission
        } else if (['hymn', 'vision', 'mission'].some(key => row.hasOwnProperty(key))) {
          // console.log(row)
          const filteredRow = Object.keys(row).reduce((obj, key) => {
            if (key === 'id' || key === token) {
              obj[key] = row[key];
            }
            return obj;
          }, {});
          dataMatched.push(filteredRow);
        }

        // console.log(row)
      });
    }
    // console.log(dataMatched)
    resolve(dataMatched.length > 0 ? dataMatched : null);
  });
}



module.exports = {
  extractKeywords
};
// export default extractKeywords