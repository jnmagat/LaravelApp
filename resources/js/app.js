import "bootstrap"; 
import "bootstrap/dist/css/bootstrap.min.css"; 
import "./fadeMessage";
import './togglePassword';
import { showToast } from "./toast";

window.showToast = showToast; // Make it globally accessible

import $ from "jquery"; 
window.$ = window.jQuery = $; 

