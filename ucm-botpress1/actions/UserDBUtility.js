/**
   * This utility can Save/Retrieve/Update data to MySQL DB
   * @title User MySQL DB Utility
   * @category Utility
   * @author Abhishek Raj Simon
   * @param {string} name - Only supports get/set/update operations
   * @param {string} table - Table name
   * @param {string} key - Can contain any key against which value needs to be pushed to DB
   * @param {string} value - Can contain a any value that needs to be pushed to DB   
   */
const userDBUtility = async (name, table, key, value) => {
  const userId = event.target
  const botId = event.botId
  user.data = undefined;
  const knex = require('knex')({
    client: 'mysql',
    connection: {
      host: 'localhost',
      user: 'root',
      password: '',
      database: 'sys'
    },
    useNullAsDefault: false,
    log: {
      warn(message) {
        console.log(message);
      },
      error(message) {
        console.error(message);
      },
      deprecate(message) {
        console.log(message);
      },
      debug(message) {
        console.log(message);
      },
    }
  });
  if (knex) {
    temp.param = value;
    let query = "", response = false;
    if ('get' === name) {
      query = "select name from " + table + " where userid='" + value + "'";
    } else if ('set' === name) {
      query = "insert into " + table + "(userid, name) values('" + key + "',' + value + ')";
    } else if ('update' === name) {
      query = "update " + table + " set " + key + " = " + value + " where userid = '" + event.payload.text + "'";
    }
    await knex.raw(query).on('query', function (data) {
      //A query event is fired just before a query takes place. Useful for logging all queries throughout your application.
      console.log("Executing: " + data.sql)
    }).then(function (data) {
      if (data.length == 2 && name === 'get') {
        user.data = data[0][0][key]
      } else if (data.length == 2 && name === 'set') {
        user.data = undefined;
      } else if (data.length == 2 && name === 'update') {
        console.log(data)
      } else {
        user.data = undefined;
      }
    }).catch(err => console.log(err));
  } else {
    console.log("knex is not initialized");
  }
}
return userDBUtility(args.name, args.table, args.key, args.value)