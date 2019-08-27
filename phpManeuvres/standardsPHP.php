Indentation #Indentation
Your indentation should always reflect logical structure. Use real tabs and not spaces, as this allows the most flexibility across clients.

Exception: if you have a block of code that would be more readable if things are aligned, use spaces:

[tab]$foo   = 'somevalue';
[tab]$foo2  = 'somevalue2';
[tab]$foo34 = 'somevalue3';
[tab]$foo5  = 'somevalue4';
For associative arrays, each item should start on a new line when the array contains more than one item:

$query = new WP_Query( array( 'ID' => 123 ) );
$args = array(
[tab]'post_type'   => 'page',
[tab]'post_author' => 123,
[tab]'post_status' => 'publish',
);
 
$query = new WP_Query( $args );
Note the comma after the last array item: this is recommended because it makes it easier to change the order of the array, and makes for cleaner diffs when new items are added.

$my_array = array(
[tab]'foo'   => 'somevalue',
[tab]'foo2'  => 'somevalue2',
[tab]'foo3'  => 'somevalue3',
[tab]'foo34' => 'somevalue3',
);
For switch structures case should indent one tab from the switch statement and break one tab from the case statement.

switch ( $type ) {
[tab]case 'foo':
[tab][tab]some_function();
[tab][tab]break;
[tab]case 'bar':
[tab][tab]some_function();
[tab][tab]break;
}
Rule of thumb: Tabs should be used at the beginning of the line for indentation, while spaces can be used mid-line for alignment.

Top ↑

Brace Style #Brace Style
Braces shall be used for all blocks in the style shown here:

if ( condition ) {
    action1();
    action2();
} elseif ( condition2 && condition3 ) {
    action3();
    action4();
} else {
    defaultaction();
}
If you have a really long block, consider whether it can be broken into two or more shorter blocks, functions, or methods, to reduce complexity, improve ease of testing, and increase readability.

Braces should always be used, even when they are not required:

if ( condition ) {
    action0();
}
 
if ( condition ) {
    action1();
} elseif ( condition2 ) {
    action2a();
    action2b();
}
 
foreach ( $items as $item ) {
    process_item( $item );
}
Note that requiring the use of braces just means that single-statement inline control structures are prohibited. You are free to use the alternative syntax for control structures (e.g. if/endif, while/endwhile)—especially in your templates where PHP code is embedded within HTML, for instance:

<?php if ( have_posts() ) : ?>
	<div class="hfeed">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID() ?>" class="<?php post_class() ?>">
				<!-- ... -->
			</article>
		<?php endwhile; ?>
	</div>
<?php endif; ?>
Top ↑

Use elseif, not else if #Use elseif, not else if
else if is not compatible with the colon syntax for if|elseif blocks. For this reason, use elseif for conditionals.

Top ↑

Declaring Arrays #Declaring Arrays
Using long array syntax ( array( 1, 2, 3 ) ) for declaring arrays is generally more readable than short array syntax ( [ 1, 2, 3 ] ), particularly for those with vision difficulties. Additionally, it’s much more descriptive for beginners.

Arrays must be declared using long array syntax.

Top ↑

Closures (Anonymous Functions) #Closures (Anonymous Functions)
Where appropriate, closures may be used as an alternative to creating new functions to pass as callbacks. For example:

$caption = preg_replace_callback(
    '/<[a-zA-Z0-9]+(?: [^<>]+>)*/',
    function ( $matches ) {
        return preg_replace( '/[\r\n\t]+/', ' ', $matches[0] );
    },
    $caption
);
Closures must not be passed as filter or action callbacks, as they cannot be removed by remove_action() / remove_filter() (see #46635 for a proposal to address this).

Top ↑

Multiline Function Calls #Multiline Function Calls
When splitting a function call over multiple lines, each parameter must be on a seperate line. Single line inline comments can take up their own line.

Each parameter must take up no more than a single line. Multi-line parameter values must be assigned to a variable and then that variable should be passed to the function call.

$bar = array(
    'use_this' => true,
    'meta_key' => 'field_name',
);
$baz = sprintf(
    /* translators: %s: Friend's name */
    esc_html__( 'Hello, %s!', 'yourtextdomain' ),
    $friend_name
);
 
$a = foo(
    $bar,
    $baz,
    /* translators: %s: cat */
    sprintf( __( 'The best pet is a %s.' ), 'cat' )
);
Top ↑

Regular Expressions #Regular Expressions
Perl compatible regular expressions (PCRE, preg_ functions) should be used in preference to their POSIX counterparts. Never use the /e switch, use preg_replace_callback instead.

It’s most convenient to use single-quoted strings for regular expressions since, contrary to double-quoted strings, they have only two metasequences: \' and \\.

Top ↑

Opening and Closing PHP Tags #Opening and Closing PHP Tags
When embedding multi-line PHP snippets within a HTML block, the PHP open and close tags must be on a line by themselves.

Correct (Multiline):

function foo() {
    ?>
        <div>
        <?php
        echo bar(
            $baz,
            $bat
        );
        ?>
        </div>
    <?php
}
Correct (Single Line):

<input name="<?php echo esc_attr( $name ); ?>" />
Incorrect:

if ( $a === $b ) { ?>
<some html>
<?php }
Top ↑

No Shorthand PHP Tags #No Shorthand PHP Tags
Important: Never use shorthand PHP start tags. Always use full PHP tags.

Correct:

<?php ... ?>
<?php echo $var; ?>
Incorrect:

<? ... ?>
<?= $var ?>
Top ↑

Remove Trailing Spaces #Remove Trailing Spaces
Remove trailing whitespace at the end of each line of code. Omitting the closing PHP tag at the end of a file is preferred. If you use the tag, make sure you remove trailing whitespace.

Top ↑

Space Usage #Space Usage
Always put spaces after commas, and on both sides of logical, comparison, string and assignment operators.

x === 23
foo && bar
! foo
array( 1, 2, 3 )
$baz . '-5'
$term .= 'X'
Put spaces on both sides of the opening and closing parentheses of if, elseif, foreach, for, and switch blocks.

foreach ( $foo as $bar ) { ...
When defining a function, do it like so:

function my_function( $param1 = 'foo', $param2 = 'bar' ) { ...

function my_other_function() { ...
When calling a function, do it like so:

my_function( $param1, func_param( $param2 ) );
my_other_function();
When performing logical comparisons, do it like so:

if ( ! $foo ) { ...
Type casts must be lowercase. Always prefer the short form of type casts, (int) instead of (integer) and (bool) rather than (boolean). For float casts use (float).:

foreach ( (array) $foo as $bar ) { ...

$foo = (bool) $bar;
When referring to array items, only include a space around the index if it is a variable, for example:

$x = $foo['bar']; // correct
$x = $foo[ 'bar' ]; // incorrect

$x = $foo[0]; // correct
$x = $foo[ 0 ]; // incorrect

$x = $foo[ $bar ]; // correct
$x = $foo[$bar]; // incorrect
In a switch block, there must be no space before the colon for a case statement.

switch ( $foo ) {
	case 'bar': // correct
	case 'ba' : // incorrect
}
Similarly, there should be no space before the colon on return type declarations.

function sum( $a, $b ): float {
	return $a + $b;
}
Unless otherwise specified, parentheses should have spaces inside of them.

if ( $foo && ( $bar || $baz ) ) { ...
 
my_function( ( $x - 1 ) * 5, $y );
Top ↑

Formatting SQL statements #Formatting SQL statements
When formatting SQL statements you may break it into several lines and indent if it is sufficiently complex to warrant it. Most statements work well as one line though. Always capitalize the SQL parts of the statement like UPDATE or WHERE.

Functions that update the database should expect their parameters to lack SQL slash escaping when passed. Escaping should be done as close to the time of the query as possible, preferably by using $wpdb->prepare()

$wpdb->prepare() is a method that handles escaping, quoting, and int-casting for SQL queries. It uses a subset of the sprintf() style of formatting. Example :

$var = "dangerous'"; // raw data that may or may not need to be escaped
$id = some_foo_number(); // data we expect to be an integer, but we're not certain
 
$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_title = %s WHERE ID = %d", $var, $id ) );
%s is used for string placeholders and %d is used for integer placeholders. Note that they are not ‘quoted’! $wpdb->prepare() will take care of escaping and quoting for us. The benefit of this is that we don’t have to remember to manually use esc_sql(), and also that it is easy to see at a glance whether something has been escaped or not, because it happens right when the query happens.

See Data Validation in the Codex for more information.

Top ↑

Database Queries #Database Queries
Avoid touching the database directly. If there is a defined function that can get the data you need, use it. Database abstraction (using functions instead of queries) helps keep your code forward-compatible and, in cases where results are cached in memory, it can be many times faster.

If you must touch the database, get in touch with some developers by posting a message to the wp-hackers mailing list. They may want to consider creating a function for the next WordPress version to cover the functionality you wanted.

Top ↑

Naming Conventions #Naming Conventions
Use lowercase letters in variable, action/filter, and function names (never camelCase). Separate words via underscores. Don’t abbreviate variable names unnecessarily; let the code be unambiguous and self-documenting.

function some_name( $some_variable ) { [...] }
Class names should use capitalized words separated by underscores. Any acronyms should be all upper case.

class Walker_Category extends Walker { [...] }
class WP_HTTP { [...] }
Constants should be in all upper-case with underscores separating words:

define( 'DOING_AJAX', true );
Files should be named descriptively using lowercase letters. Hyphens should separate words.

my-plugin-name.php
Class file names should be based on the class name with class- prepended and the underscores in the class name replaced with hyphens, for example WP_Error becomes:

class-wp-error.php
This file-naming standard is for all current and new files with classes. There is one exception for three files that contain code that got ported into BackPress: class.wp-dependencies.php, class.wp-scripts.php, class.wp-styles.php. Those files are prepended with class., a dot after the word class instead of a hyphen.

Files containing template tags in wp-includes should have -template appended to the end of the name so that they are obvious.

general-template.php
Top ↑

Self-Explanatory Flag Values for Function Arguments #Self-Explanatory Flag Values for Function Arguments
Prefer string values to just true and false when calling functions.

// Incorrect
function eat( $what, $slowly = true ) {
...
}
eat( 'mushrooms' );
eat( 'mushrooms', true ); // what does true mean?
eat( 'dogfood', false ); // what does false mean? The opposite of true?
Since PHP doesn’t support named arguments, the values of the flags are meaningless, and each time we come across a function call like the examples above, we have to search for the function definition. The code can be made more readable by using descriptive string values, instead of booleans.

// Correct
function eat( $what, $speed = 'slowly' ) {
...
}
eat( 'mushrooms' );
eat( 'mushrooms', 'slowly' );
eat( 'dogfood', 'quickly' );
When more words are needed to describe the function parameters, an $args array may be a better pattern.

// Even Better
function eat( $what, $args ) {
...
}
eat ( 'noodles', array( 'speed' => 'moderate' ) );
Top ↑

Interpolation for Naming Dynamic Hooks #Interpolation for Naming Dynamic Hooks
Dynamic hooks should be named using interpolation rather than concatenation for readability and discoverability purposes.

Dynamic hooks are hooks that include dynamic values in their tag name, e.g. {$new_status}_{$post->post_type} (publish_post).

Variables used in hook tags should be wrapped in curly braces { and }, with the complete outer tag name wrapped in double quotes. This is to ensure PHP can correctly parse the given variables’ types within the interpolated string.

do_action( "{$new_status}_{$post->post_type}", $post->ID, $post );
Where possible, dynamic values in tag names should also be as succinct and to the point as possible. $user_id is much more self-documenting than, say, $this->id.

Top ↑

Ternary Operator #Ternary Operator
Ternary operators are fine, but always have them test if the statement is true, not false. Otherwise, it just gets confusing. (An exception would be using ! empty(), as testing for false here is generally more intuitive.)

The short ternary operator must not be used.

For example:

// (if statement is true) ? (do this) : (else, do this);
$musictype = ( 'jazz' === $music ) ? 'cool' : 'blah';
// (if field is not empty ) ? (do this) : (else, do this);
Top ↑

Yoda Conditions #Yoda Conditions
if ( true === $the_force ) {
	$victorious = you_will( $be );
}
When doing logical comparisons involving variables, always put the variable on the right side and put constants, literals, or function calls on the left side. If neither side is a variable, the order is not important. (In computer science terms, in comparisons always try to put l-values on the right and r-values on the left.)

In the above example, if you omit an equals sign (admit it, it happens even to the most seasoned of us), you’ll get a parse error, because you can’t assign to a constant like true. If the statement were the other way around ( $the_force = true ), the assignment would be perfectly valid, returning 1, causing the if statement to evaluate to true, and you could be chasing that bug for a while.

A little bizarre, it is, to read. Get used to it, you will.

This applies to ==, !=, ===, and !==. Yoda conditions for <, >, <=, or >= are significantly more difficult to read and are best avoided.

Top ↑

Clever Code #Clever Code
In general, readability is more important than cleverness or brevity.

isset( $var ) || $var = some_function();
Although the above line is clever, it takes a while to grok if you’re not familiar with it. So, just write it like this:

if ( ! isset( $var ) ) {
	$var = some_function();
}
Unless absolutely necessary, loose comparisons should not be used, as their behaviour can be misleading.

Correct:

if ( 0 === strpos( 'WordPress', 'foo' ) ) {
	echo __( 'Yay WordPress!' );
}
Incorrect:

if ( 0 == strpos( 'WordPress', 'foo' ) ) {
	echo __( 'Yay WordPress!' );
}
Assignments must not be placed in placed in conditionals.

Correct:

$data = $wpdb->get_var( '...' );
if ( $data ) {
    // Use $data
}
Incorrect:

if ( $data = $wpdb->get_var( '...' ) ) {
    // Use $data
}
In a switch statement, it’s okay to have multiple empty cases fall through to a common block. If a case contains a block, then falls through to the next block, however, this must be explicitly commented.

switch ( $foo ) {
	case 'bar':	      // Correct, an empty case can fall through without comment.
	case 'baz':
		echo $foo;    // Incorrect, a case with a block must break, return, or have a comment.
	case 'cat':
		echo 'mouse';
		break;        // Correct, a case with a break does not require a comment.
	case 'dog':
		echo 'horse';
		// no break   // Correct, a case can have a comment to explicitly mention the fall through.
	case 'fish':
		echo 'bird';
		break;
}
The goto statement must never be used.

The eval() construct is very dangerous, and is impossible to secure. Additionally, the create_function() function, which internally performs an eval(), is deprecated in PHP 7.2. Both of these must not be used.

Top ↑

Error Control Operator @ #Error Control Operator @
As noted in the PHP docs:

PHP supports one error control operator: the at sign (@). When prepended to an expression in PHP, any error messages that might be generated by that expression will be ignored.

While this operator does exist in Core, it is often used lazily instead of doing proper error checking. Its use is highly discouraged, as even the PHP docs also state:

Warning: Currently the “@” error-control operator prefix will even disable error reporting for critical errors that will terminate script execution. Among other things, this means that if you use “@” to suppress errors from a certain function and either it isn’t available or has been mistyped, the script will die right there with no indication as to why.

Top ↑

Don’t extract() #Don’t extract()
Per #22400:

extract() is a terrible function that makes code harder to debug and harder to understand. We should discourage it’s [sic] use and remove all of our uses of it.

Joseph Scott has a good write-up of why it’s bad.

Top ↑

Credits #Credits
PHP standards: Pear standards
Top ↑

Major Changes #Major Changes
November 13, 2013: Braces should always be used, even when they are optional
June 20, 2014: Add section to discourage use of the error control operator (@). See #wordpress-dev.
October 20, 2014: Update brace usage to indicate that the alternate syntax for control structures is allowed, even encouraged. It is single-line inline control structures that are forbidden.
January 21, 2014: Add section to forbid extract().
 Hide Comments

Tom Willmot 5:42 am on April 12, 2013
The code example for the “Yoda Conditions” block is missing a space between the `if` and the opening parenthesis `(`, it should be `if ( true == $the_force ) {` instead of `if( true == $the_force ) {`


Tom Willmot 7:27 am on April 12, 2013
Happy to edit it myself if thats possible


Kim Parsell 8:12 am on April 12, 2013
Fixed – thanks for pointing that out. 🙂


zilli 12:39 am on April 17, 2013
Twenty Thirteen and _s themes are using if-endif brace style. A lot of developers prefer this style too over the traditional {}.

Isn’t time to update the handbook?


daigo75 11:12 am on May 2, 2013
I think that braces are just fine, I don’t like the “if-endif” style at all (I’m not a fan of Yoda statements either).


Old 2:50 am on September 11, 2013
I don’t think it’s about taste, but standards. I think both syntaxes should be ok, otherwise if I’m a newbie and I use Twenty Thirteen or _s as my objects of learning… I’ll be doing ‘wrong’ without knowing.


J.D. Grimes 2:29 pm on May 29, 2013
if-endif is more readable when used in HTML, for example a page template. But I prefer braces everywhere else.


Antonio 2:33 am on June 8, 2013
Please Do Not Use Curly Brackets {} in Template Files


TuKod dot Com 2:56 am on May 9, 2014
I think the real question has not been addresses.

Are we placing php into html?
Or putting html into php?

In other words, are they template pages, or code processing pages?

A day is coming where people will see the power and value of separating the “code process” from the “template output.”

Consider a template in which no php exist other than if/endif control, <?= $var >, for var output, and perhaps a call to a function in a class. Everything else in the template would be html!

If the code you are working on is mostly php, then most would agree that braces are the cleanest way to go. With editors that do “Indentation Guides” (Geany, Notepad++, etc.) this makes code reading easy.

On the other hand, if your code is mainly html, and you are only inserting php for control or to pop in a variables, then the if/endif structure and <?= $var >, is more readable for insertion into an html template.

This is actually the same with short tags. <? was a nightmare. However, <?= $var > should be encouraged in templates. Even in the php core itself, the short tag < is being deprecated, whereas the short echo <?= will soon be a default, and will not even need to be enabled!

The php gods themselves have smiled on <?= $var > and it only remains to see how much time it takes before the WordPress Core makes this an acceptable template standard as well.


Weston Ruter 11:16 am on October 20, 2014
I don’t believe the handbook here is trying to say that the alternative syntax for control structures is prohibited, just that single-line inline control structures are. This is how the WordPress Coding Standards for PHP_CodeSniffer have interpreted this.

There currently 105 instances of the alternative syntax being used in Core, including the newly-added Twenty Fifteen theme.


Weston Ruter 11:28 am on October 20, 2014
I’ve updated the handbook to indicate that the alternative syntax is allowed, even encouraged: https://make.wordpress.org/core/handbook/coding-standards/php/#brace-style


Weston Ruter 11:35 am on October 20, 2014
See also https://core.trac.wordpress.org/ticket/24549 which has been closed wontfix. Alternative syntax for control structures are here to stay.


Kailey Lampert (trepmal) 12:14 am on May 7, 2013
Under No Shorthand PHP tags

<?php = $var ?> should be <?php echo $var ?>


Kim Parsell 5:22 am on May 8, 2013
Fixed. Thanks Kailey! 🙂


M.K. Safi 9:05 am on May 24, 2013
You need to explain your “Space Usage”. It seems arbitrary to me and I have a hard time remembering the specifics because I don’t know why I’m doing it…


Aaron D. Campbell 9:56 am on May 29, 2013
All the spacing is for readability. In our experience, this spacing produces the easiest to read code, and prevents accidental missteps. For example, spacing the ! away from the variable or function in an if statement makes it stand out so it’s easy to see at a glance what’s going on.


Mal 6:54 am on June 15, 2013
It’s also a little weird for me that spaces should go everywhere. I see such standard for the first time in WordPress. I have a 1200 pages book about PHP (one of the best in the world at this moment) and they do it like this: http://pear.php.net/manual/en/standards.funcdef.php and like php.net – http://pl1.php.net/manual/en/function.function-exists.php (they never put additional spaces after every single quote and every bracket). Is this something that is likely to change in the future? This is not a PHP standard.


George Stephanis 11:13 am on June 22, 2013
There is no ‘PHP Standard’. There are a number of competing standards (CodeIgniter, Zend, Symfony, the PEAR one you linked, others…), we’ve just chosen one that works for us, and try to be consistent with it.

The WP Coding Standards for PHP are not likely to change in the near future, no.

Just always indent with tabs, and we won’t have a problem.  😉


lwoods 2:34 pm on June 23, 2013
I recommend discouraging the use of the PHP increment and decrement operators except where necessary, such as in the ‘for’ comment:

If you are not familiar with this operator:

$i = 5;
echo ++$i; // display 6
echo $i–; // display 6 again
echo $i; // display 5

In debugging code it is very easy to miss the effect of these operators.

On the other hand, it is common and encouraged to use these operators in the ‘for’ loop:

for ( $j=0; $j<5; $j++ ){
.
.
.
}


lwoods 2:38 pm on June 23, 2013
I disagree with the following under “Brace Style”:

Single line blocks can omit braces for brevity:

if ( condition )
action1();
elseif ( condition2 )
action2();
else
action3();

ALL IF statements should be braced! Although they are not needed in the above example the absence of braces can be very confusing if you start nesting IF statements. I have seen multiple single line blocks in nested IF statements that were near to impossible to debug.


8:00 am on July 10, 2013
I agree with @lwoods.

I find that the “Clever Code” part of this document contradicts “Yoda Conditions”.

I find reading Yoda Conditions much slower than normal conditions. It seems that Yoda Conditions are just there to prevent you from writing broken code, which you should just not do. Learn to use the correct numbe of = instead.

This also applies to the example in the Ternary Operator section which uses a Yoda Condition.

To me, ( ‘jazz’ == $music ) … would return true.. because jazz is music. Whereas ( $music == ‘jazz’ ), or even ( $music_genre == ‘jazz’ ) makes so much more sense.


Andrew Nacin 8:49 am on July 11, 2013
Yoda conditions are a programming best practice, and not overly clever. They’re going to remain part of the standard. Thanks for your input.


markparolisi 6:14 am on July 21, 2013
I wouldn’t call them a programming best practice since many languages wouldn’t even let you declare variables inside a condition. The best way to avoid this problem is to avoid declaring variables in that way. It serves no purpose but to save yourself one line of code.


Gary Jones 4:57 am on July 24, 2013
It’s not declaring anything. It’s trying to avoid accidental assignment to a variable.


TuKod dot Com 3:28 am on May 9, 2014
Honestly Andrew, I teach my students to use Yoda Conditions, for their benefit, to try to trap their errors before they have to labor over them. However, honestly most would rather use “Logical Conditions” (the opposite of Yoda Conditions!)

One of my students recommended simply debugging with a “mark” search for ‘ = ‘. A visual scan of the page will usually expose any incorrect Logical Condition. Almost as simply as Yoda Conditions.

Likewise, virtually everyone would admit a properly formated Logical Condition is easier to read that an equivalent properly formated Yoda Condition. So calling Yoda Conditions a best practice is a bit of a stretch when refining code blocks (as in future updates).

My suggestion would be simply to suggest Yoda Conditions, rather than elevate them to the level of “Best Practice” or the higher level of a “Standard!”

That is my opinion, but like armpits, we all have a couple of them!

However… I have been reading a lot of WordPress code (plugins, themes, etc.) that violate the Yoda Conditions “Standard”, it would be interesting to test this with a simple search for something like

== ‘
or
== ”

This would be a good test for the Yoda police to use in accepting new themes and plugins!

The force with you, maybe?

Star Wars 7 is coming with the original cast of the first movie! Will Yoda be there in spirit?


Jon Brown 12:41 am on July 11, 2013
Regarding braces and php tags, I run into this where php tags get thier own line often:

function do_stuff() {
    if ( condition ) {
        ?> 
        <ul>
            <li>something1</li>
            <li>something2</li>
        <ul>
        <?php 
    }
}
personally, I prefer this:

function do_stuff() {
    if ( condition ) { ?> 
        <ul>
            <li>something1</li>
            <li>something2</li>
        <ul>
    <?php }
}
I’m really not sure which is right/wrong in the WordPress universe. Reviewing core, I think I’m right? Which is the WP way?


Andrew Nacin 8:52 am on July 11, 2013
I don’t think WordPress is particularly consistent either way. At the moment, it depends on what is most readable for that situation. (Also, in general, we use if/endif when we are forced to break into HTML.)


TuKod dot Com 1:58 am on May 9, 2014
Hey Jon and Andrew!

Our shop puts the closing php at the end of the php block, and the opening php at the end of the HTML.

This makes good reading on editors like Geany and NotepadPlusPlus that have “Indentation Guides.” Like this…

function do_stuff() {
if ( condition ) { ?>

something1
something2
. It also gives a good visual clue that the php has stopped and the HTML has started when reading the php source.
Like this…

function do_stuff() {
if ( condition ) { ?>

something1
something2
<?php
}
}
Of course, as you pointed out, this comes from my familiarity with the "change at the end of the line programming" dating back to work at ARPA (later called DARPA) in the early 1970's But I noticed it applied well to the newly introduced PHP in the mid to late 1990's.


TuKod dot Com 2:14 am on May 9, 2014
OOPS! The above should be,,,

Hey Jon and Andrew!

Our shop puts the closing php at the end of the php block, and the opening php at the end of the HTML.

This makes good reading on editors like Geany and NotepadPlusPlus that have “Indentation Guides.” Like this…

function do_stuff() {
    if ( condition ) { ?>
        

            
something1

            
something2

        
<?php
    }
}
And… By adding a blank line before the html, it contracts the loss of a line at the close of php. This makes the output html more readable. It also gives a good visual clue that the php has stopped and the HTML has started when reading the php source.

Like this…

function do_stuff() {
    if ( condition ) { ?>

        

            
something1

            
something2

        
<?php
    }
}
Of course, as you pointed out, this comes from my familiarity with the “change at the end of the line programming” dating back to work at ARPA (later called DARPA) in the early 1970’s But I noticed it applied well to the newly introduced PHP in the mid to late 1990’s.