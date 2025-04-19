

<?php

    class moreORless extends Plugin {

        public function init(){
            $this->dbFields = array(
        'redirect'=> 'no',
		'showOnPage'=> 'yes',
		'background'=> '#0088CC',
        'textColor'=> '#E9E9E9',
            );
        }

		
	public function pageBegin()
	{ 
		global $page;
		echo Theme::jquery();
	$showOnPage = $this->getValue('showOnPage');
	$redirect = $this->getValue('redirect');
		
		// if show on a page == true
	$onPage = strpos($_SERVER["REQUEST_URI"],$page->key());

	if ($showOnPage!='no' || $onPage==false) {
		$newcontent = str_replace( '[readMore]',
			"<div><div class='readLess' style='display:none;padding-left:6px;border-left:1px dashed #363636'>",
			$page->content() );
				$page->setField('content', $newcontent);
		}

// set a redirect?
if ($redirect=='yes') {
	if (HTML_PATH_ROOT == $_SERVER["REQUEST_URI"]) {
		$pageBase = $page->key(); // redirect set in jquery
			}
	// if a specific page is set as homepage
	elseif (HTML_PATH_ROOT.'blog/' == $_SERVER["REQUEST_URI"]) {
		$pageBase = '../'.$page->key();
			}
	else { $pageBase = 'nil'; }
	}
else { $pageBase = 'nil'; }


if ($showOnPage!='no' || $onPage==false) {
		$newcontent = str_replace( '[readLess]',
			"</div><span class='readP' name='".$pageBase."' style='cursor:pointer;background:".$this->getValue('background').";color:".$this->getValue('textColor').";padding:2px 8px;font-size:18px;border-radius:4px;'>read more</span></div>",
			$page->content() );
				$page->setField('content', $newcontent);
		}

// we are on a page & tags are unchanged so swap them out
if ($showOnPage=='no' && strpos($_SERVER["REQUEST_URI"],$page->key())
		 ) {
		$newcontent = str_replace( '[readMore]','',$page->content() );
			$page->setField('content', $newcontent);
		$newcontent = str_replace( '[readLess]','',$page->content() );
			$page->setField('content', $newcontent);
	}
?>
			
<script>
$(document).ready(function() {
	
// toggle readMore/Less
	$('body').on('click', '.readP', function(e) { 
	e.preventDefault();
	e.stopImmediatePropagation(); 
			readLink = $(this).attr('name'); //alert(readLink)
	if (readLink=='nil') { // no redirect
     if ($(this).html()=='read more') { $(this).html('read less');
		$(this).prev('.readLess').css({'display': 'block'});}
     else { $(this).html('read more');
		$(this).prev('.readLess').css({'display': 'none'}); }
		}
	else { window.location.href = readLink; }	

			}); // END toggle readMore

});
</script>

<?php

	}
	
	public function form(){ 
	?>
	<style>
.radio { display:inline-block; width:15px; height:15px;  }
hr { height:4px; background:#039100; }
</style>
<?php
	$circle = '<span style="display:inline-block; width:20px; height:20px; text-align:center; border-radius:50%; background:#ffba61; padding-right:2px;">';
		echo 'Toggle the visibility of tagged content on any page.
		<BR><BR>
		<h4>Settings:</h4>
		Hopefully the relationship between 1 & 2 is clear. There are four permutations (no/no, no/yes, yes/no, yes/yes).
		<HR>';
echo $circle .'1</span> On the blog-listing page have the <B>readMore tag redirect/link</B> to the relevant page?
		<BR><BR>';
		$director = $this->getValue('redirect');
			$director=='no'; // default
		if ($director=='no') { $noCheck = 'checked'; }
			else { $noCheck = ''; }
		if ($director=='yes') { $yesCheck = 'checked'; }
			else { $yesCheck = ''; }
		
		echo '<div style="margin-left:44px;"><input '.$noCheck.' class="form-control radio" type="radio" name="redirect" value="no"> No &nbsp;&nbsp;[works on all pages; unless you set (2) to \'no\']
		<BR>
		<input '.$yesCheck.' class="form-control radio" type="radio" name="redirect" value="yes"> Yes &nbsp;&nbsp;[the tag/link will direct to that page]</div>
		<BR>';
		
echo $circle .'2</span> <B>Show tags on single-pages?</B> Maybe, if (1) is \'yes\', then loading the page means the reader wants it all; nothing concealed.
		<BR><BR>';
		$showOnPage = $this->getValue('showOnPage');
			$showOnPage=='no'; // default
		if ($showOnPage=='no') { $noCheck = 'checked'; }
			else { $noCheck = ''; }
		if ($showOnPage=='yes') { $yesCheck = 'checked'; }
			else { $yesCheck = ''; }
		
	echo '<div style="margin-left:44px;"><input '.$noCheck.' class="form-control radio" type="radio" name="showOnPage" value="no"> No &nbsp;&nbsp;[tags removed on single pages but visible on the blog-list; with operation qualified by (1)]
		<BR>
		<input '.$yesCheck.' class="form-control radio" type="radio" name="showOnPage" value="yes"> Yes &nbsp;&nbsp;[tags are visible/operational on all pages]</div>
		<BR>';
		
echo $circle .'3</span> <B>Background color</B> for the readMore/Less button.
	<BR><BR>
	<input type="color" value="'.$this->getValue('background').'" class="form-control form-color" name="background">
	<BR><BR>
	';
echo $circle .'4</span> <B>Text color</B> for the readMore/Less button.
	<BR><BR>
	<input type="color" value="'.$this->getValue('textColor').'" class="form-control form-color" name="textColor">
	<BR><BR>
		ps. To further edit existing css open plugin.php in a text editor and find "$newcontent" and make changes.
		<HR><BR>';

// which pages readMore is set on		

	echo '<h4>Usage:</h4>
		The [readMore] tag is used on the following pages:
		Click to edit.<BR>Be sure to remove *both* tags if you deactivate the plugin.<BR><BR>';

	$content =  './bl-content/pages';
	$readUsed='';
	if ($handle = opendir($content)) {
			while (false !== ($dirs = readdir($handle))) {
				if ($dirs[0] != "." && !strstr($dirs,'autosave')) {
			$readIt = file_get_contents($content.'/'.$dirs.'/index.txt', true);
			if (strpos($readIt,'[readMore]')) { // there is a read*
		$readUsed .= '<div style="display:inline-block; width:122px; border:1px solid black; padding-left:9px;"><a href="../../admin/edit-content/'.$dirs.'">'.$dirs.'</a></div>';
			} // end 'is read'
			} // end 'got dirs'
			} 
				closedir($handle); }
		if (!empty($readUsed)) { echo '<div style="border-left:4px solid #0088CC; padding:12px;">'.$readUsed.'</div>'; }
		else { echo '<div style="border-left:4px solid #0088CC; padding:12px;">No tags found.</div>'; }

echo '<BR><HR><BR>';		
		echo '<h4>How to:</h4>
		Edit the page and place tags:
		<BR>
		<B>[readMore]</B> at the start of of the content block and
		<BR>
		<B>[readLess]</B> at the end of that block.
		<BR><BR>
		Blocks can be nested - as long as there are matching pairs of<BR>
		[readMore] & [readLess].
		<BR><BR>
		If you want to add buttons to tinyMCE...
		<BR>
		Go to admin > plugins > tinyMCE settings.
		<BR>
		In the toolbar, at the end of the button list, add:  | readMore readLess
		<BR>
		Then in tinymce plugin.php find "tinymce.init({" and add (I did it at the end, after "codesample_languages: [$codesampleConfig],") the following code:
<BR><BR>
<pre>
	setup: function (editor) { // ak add
	editor.ui.registry.addButton("readMore", {
	text: "read+",
	onAction: function (_) {
	editor.insertContent("[readMore]");
		}
		});
	editor.ui.registry.addButton("readLess", {
	text: "read-",
	onAction: function (_) {
	editor.insertContent("[readLess]");
		}
		});
			}
		</pre>
		
Another tinyMCE option is to select the block to be hidden and one-click wrap it with tags.
<BR>
Add this code to the tinyMCE plugin.php (as above - either in place of or as well as :)
<BR><BR>
<pre>
	editor.ui.registry.addButton("readWrap", {
	text: "Wrap+/-",
	title: "wrapp",
	onAction: function (_) {
	editor.insertContent("[readMore]&lt;BR&gt;"+
	editor.selection.getContent({format: "raw"}) + "&lt;BR&gt;[readLess]");
	}
	});
</pre>
<BR>
Go to admin > plugins > tinyMCE settings.
<BR>
In the toolbar, at the end of the button list, add: "readWrap"
<BR>
You can change the text that appears on the toolbar by changing the plugin text: currently: Wrap+/-
<BR><BR><BR>
		';
	}

    };


