const mysql = require('mysql');
const dotenv = require('dotenv');

// axxessing env varialbles
dotenv.config({ path: './.env' });
// console.log(process.env.DB_PORT)
function establishConnectionAndFetchSchema() {
  return new Promise((resolve, reject) => {
    // Create a MySQL connection
    const connection = mysql.createConnection({
      host: 'localhost',
      user: process.env.DB_USERNAME,
      password: process.env.DB_PASSWORD,
      database: process.env.DB_DATABASE,
      port: process.env.DB_PORT,
    });

    // Establish the database connection
    connection.connect((error) => {
      if (error) {
        reject(`Database connection failed: ${error}`);
        console.log('rejected')
      } else {
        console.log('Database connected successfully');
        var avoidTable = 'frequentlies';
        // Fetch the schema
        const schemaQuery = `SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE
                             FROM INFORMATION_SCHEMA.COLUMNS
                             WHERE TABLE_SCHEMA = '${connection.config.database}'
                             AND TABLE_NAME NOT IN ('frequentlies','users')`;

  
        connection.query(schemaQuery, (schemaError, schemaResults) => {
          if (schemaError) {
            reject(`Error fetching schema: ${schemaError}`);
          } else {
            const schema = {};

            schemaResults.forEach((row) => {
              const tableName = row.TABLE_NAME;
              const columnName = row.COLUMN_NAME;
              const dataType = row.DATA_TYPE;

              if (!schema[tableName]) {
                schema[tableName] = [];
              }

              schema[tableName].push({ columnName, dataType });
            });

            // Fetch the data
            const dataQuery = 'SELECT * FROM ??';
            const tableNames = Object.keys(schema);

            const fetchDataPromises = tableNames.map((tableName) => {
              return new Promise((resolveData, rejectData) => {
                connection.query(dataQuery, [tableName], (dataError, dataResults) => {
                  if (dataError) {
                    rejectData(`Error fetching data for table '${tableName}': ${dataError}`);
                  } else {
                    resolveData({ tableName, data: dataResults });
                  }
                });
              });
            });

            Promise.all(fetchDataPromises)
              .then((data) => {
                // with schema
                const result = { schema, data };
                // const result = { data };
                // console.log(JSON.stringify(result, null, 2)); // Print the formatted result
                resolve(result);
              })
              .catch((dataError) => {
                reject(`Error fetching data: ${dataError}`);
              });
          }

          connection.end(); // Close the database connection
        });
      }
    });
  });
}
module.exports  = {establishConnectionAndFetchSchema}
// export default  establishConnectionAndFetchSchema;
