import fs from "fs";

const buffer = fs.readFileSync('error.log')
                 .toString()
                 .replace(/\\n/g, '\n')
console.log(buffer)