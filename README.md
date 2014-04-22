## Statamic add-on modifiers : callout

### Description

This is a simple statamic modifier (filter) that allows the user to mark sections of the content area for special styling. The primary use case for this modifier is for making Confluence-style callout blocks so that important or notable sections of content can be highlighted in the text. Generally, this means that an entire paragraph will be style using a special class.

I have used this technique on a Jekyll-based static website thanks to an informative article written by Frank Caron [here](http://frankcaron.com/Flogger/?p=5163). It can be very useful in technical or informational articles so that important information can stands out from the regular content flow. In short, it is a useful tool for 21st century attention spans.

This modifier works by using two defined 'callout identification' beginning and ending character strings.  

The opening character string is ```{% classname```. This string marks the beginning of the important block of text and the word following the class is whatever classname you choose to give it. This flexible classname convention will allow multiple types of styling for different types content that is to be singled out.

The second character string is the closing string ```%}``` which will mark the end of the block of text to be highlighted. 

The modifier by default will substitute ```<div class="classname">``` for the opening string and ```</div>``` for closign string.

I can forsee that some users might like to use another type of html tag such as the ```<span>``` tag for the callout text, and this can be accomplished by adding a parameter to the modifer when it is used in a template.

### Installation

Drop the folder *callout* in the add-ons folder in your Statamic project. Inside this folder is the modifier .php file. 

### Usage

#### Use inside the content area

When adding content, the pre-defined 'callout identification' strings are used to mark the region where the content is to be surrounded by html tags for further styling.

So a blog posting might look like this with the default 'callout identification' strings:

```
---
title: A sample post
categories:
  - trivia
  - grammar
---
[=A large collection of code samples which have been tested against GitHub's markdown parser... so you don't have to.=]

This is some additional boilerplate text that I will use to test the callout content modifer code. It should pass

{% callout Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. %} 
```
And the second paragraph will be surrounded by a div tag with the class "*callout*".


#### Use inside a template


```
<li >
	<h1>
		{{ title }}
	</h1>
	<p>
		posted on {{ date }}
	</p>
	
	{{ content|callout|widont }}
</li>
```

There may be a case where you do not want to mark text with a div but would rather surround it with ```<span>``` tags. In this case the content tag would be styled like so:

```
{{content|callout:span|widont}}
```
And the callout text will be surrounded with a span tag instead. Note that the tag type is determined in the template, but the class of the tag is determined in the actual markdown content in a given post or page.


#### Some styling starting points

Using the excellent article by Frank Caron as a starting point, here is some CSS that can be used for a simple informational callout style on a div:
```
/* -- Styling for notes callout tag -- */

.callout{
    background-color:#fffdd6;
    border-color:#ecd67f;
    box-shadow:inset 0 1px 0 rgba(255,255,255,.4), 0 11px 25px 2px rgba(0,0,0,0.36), 0 0 0 1px rgba(0, 0, 0, 0.2);
	padding: 1em;
    margin: 0em -1em 1em -1em;
}
.callout p{
  padding-top: 1em;
  margin:0em;
}
.callout:before{
    position:relative;
    content: ""; 
    color: #a77200;
    background:url('../img/note_information.png');
    background-repeat: no-repeat;
    background-position: 0px 0px;
    width: 32px;
    height: 40px;
    left:-0px;
    margin-right: -0px;
    top: 20px;
    float:left;
    clear:right;
    padding-right: 5px;
    padding-bottom: 5px;
}
```
Which will yield a callout in the text that appears like this:
![Callout example](http://www.clayharmon.com/images/callout.png)

### Caveats and warnings

Note that Statamic modifiers should have NO spaces between before or after the pipe ```'|'```!

Also note that if you are chaining modifiers like "widont", this should come first in the chain so that the line lengths are evaluated accurately. In other words, the tag should look like ```{{content|callout|widont}}```. 

I toyed with the idea of specifying both tag type and classname in the callout opening delimiter, but ran into the problems of recognizing if there was only one or two parameters after the opening ```{%``` tag. I figured most people will need this primarily for styling entire paragraphs, so the block-level div tag seemed an appropriate default.







