import * as fs from 'fs';
import * as path from 'path';

export const ROOT = fs.existsSync(__dirname + '/public/') ? path.resolve(__dirname)
    : path.resolve(__dirname, '../');
