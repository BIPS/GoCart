Copyright (C) 2011-2014 by BIPS

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

About
=====
+ Bitcoin payments via BIPS for GoCart.
+ Version 0.1
	
System Requirements:
===================
+ BIPS API, Merchant Secret
+ Curl PHP Extension
+ JSON Encode
  
Configuration Instructions:
==========================
    1. Upload files to your GoCart installation.
    2. Go to your GoCart administrative settings. Payment Modules -> "BIPS" click [Install]
    3. In BIPS Callback URL (https://bips.me/merchant) Enter the link to your callback of BIPS GoCart Payment Module. (http://YOUR_GOCART_URL/index.php/bitcoin)
    4. Enter a strong Secret in Merchant SECRET.
    5. In module settings "API" <- set your BIPS API Key, which can be generate under API Keys, Invoice.
    6. In module settings "Secret" <- Enter your BIPS Merchant Secret.

### Tested with:

+ GoCart v2.2.1 or lower