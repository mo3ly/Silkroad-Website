<?php
//Error report
error_reporting(1);

//Start..
session_start();
ob_start();

/* MSSQL Class */
include('/main/config.php');
include('/main/classes/mssql-class.php'); 

// All require files
include('/main/Functions.php');
include('/main/classes/items-class.php');
include('/main/classes/spin-class.php');
include('/main/classes/paginiation-class.php');

//New Function
$sql = new SQL($host,$user,$password,$dbs);
$func = new BasicFunctions();
$instance = CItemClass::Instance();
$pgn = new Pagenation();
$sp = new Spin();

?>
	    <?php
		//Beta Phase
		if ($OpenBeta == false){
		//Switch pages..
		if($_GET){
        $MainPages =    $_GET['main'];
        $getSup =       $_GET['sup'];
        $getThird =     $_GET['third'];
        $getForth =     $_GET['forth'];
		
    switch(strtolower($MainPages)){
		
		/*
		Basics for every page {
		$PageURL = url for page.
		$TopTitle = main title on head.
		$PageMainTitle = The main Title on slider.
		}
		
		additionals
		$HeaderStatus = 'display' to hide the slider
		*/
		
		//Main pages
		
		
		/** Forum **/
		
		// Forum
        case("forum" && ($getSup == "DiscussionsTopic")):
            $PageURL = '/pages/forum/discussions-topic.php';
			$PageMainTitle = '/ <a style="text-decoration:none" href="/forum">Forum</a>';
			if ((int)$getThird){
				 $TopicQry = $sql->query("SELECT Title FROM $dbs[WEB]..[ForumTopic] WHERE [TopicID] = '$getThird' ");
                 $Data = $sql->QueryFetchArray($TopicQry);
                 $TitleTopic = $Data["Title"];
			}
			$OtherTitle = ''.$TitleTopic.' ';
			$TopTitle= ''.$TitleTopic.' &#8211; FORUM &#8211; GAME DISCUSSION';
		    break;
		
		// Forum discussions section
        case("forum" && ($getSup == "discussions")):
            $PageURL = '/pages/forum/discussions.php';
			$PageMainTitle = '/ <a style="text-decoration:none" href="/forum">Forum</a>';
			$OtherTitle = 'Discussion';
			$TopTitle= 'FORUM &#8211; GAME DISCUSSION';
		    break;
			
		// Forum
        case("forum"):
            $PageURL = '/pages/forum/forum.php';
			$PageMainTitle = 'Forum';
			$TopTitle= 'FORUM';
		    break;
		
		
		// Search
        case("search"):
            $PageURL = '/pages/others/search.php';
			$PageMainTitle = 'Search';
			$TopTitle= 'SEARCH';
		    break;
			
		// Notification
        case("notifications"):
            $PageURL = '/pages/notifications/full-notifications.php';
			$PageMainTitle = 'Notifications';
			$TopTitle= 'NOTIFICATIONS';
		    break;
		
			
		// news
        case("news"):
            $PageURL = '/pages/news/topic.php';
			$PageMainTitle = 'News';
			$TopTitle= 'NEWS';
		    break;
			
		// Stall
        case("stall"):
            $PageURL = '/pages/stall/stall.php';
			$PageMainTitle = 'Stall';
			$TopTitle= 'STALL';
		    break;
			
		// Archive
        case("archive"):
            $PageURL = '/pages/news/archive.php';
			$PageMainTitle = 'Archive';
			$TopTitle= 'ARCHIVE';
		    break;
			
		// Archive
        case("contact"):
            $PageURL = '/pages/others/contact.php';
			$PageMainTitle = 'Contact us';
			$TopTitle= 'CONTACT US';
		break;
		
		// activation
        case("account" && ($getSup == "activation")):
            $PageURL = '/pages/account/activation.php';
			$PageMainTitle = 'Activation';
			$TopTitle= 'ACTIVATION';
		    break;
		// Re-send verification code
        case("account" && ($getSup == "verify")):
            $PageURL = '/pages/account/verfiy-resend.php';
			$PageMainTitle = 'Verification Code';
			$TopTitle= 'VERIFICATION CODE RESEND';
		    break;
		// forgot
        case("account" && ($getSup == "forgot")):
            $PageURL = '/pages/account/forgot.php';
			$PageMainTitle = 'Forgot page';
			$TopTitle= 'FORGOT PAGE';
		    break;
			
		//tickets
		case(("account" && $getSup == "tickets")):
            $PageURL = '/pages/account/ticket-system/tickets.php';
			$TopTitle = 'TICKETS';
			$PageMainTitle = 'Tickets';
        break;
		//Account pane;
		case(("account" && $getSup == "panel")):
            $PageURL = '/pages/account/panel/panel.php';
			$TopTitle = ''.strtoupper($_SESSION['username']).' ACCOUNT PANEL';
			$PageMainTitle = ''.$_SESSION['username'].' Panel';
        break;
		
		//view tickets
		case("account" && ($getSup == "viewticket")):
            $PageURL = '/pages/account/ticket-system/viewticket.php';
			$TopTitle = 'VIEW TICKET';
			$PageMainTitle = 'Ticket view';
        break;
		
			
		// Set first password
        case("account" && ($getSup == "setpassword")):
            $PageURL = '/pages/account/firstlogin.php';
			$TopTitle = 'FIRST LOGIN INFORMATION';
			$PageMainTitle = 'First login information';
            break;
			
		// register
        case("register"):
            $PageURL = '/pages/account/register.php';
			$TopTitle = 'REGISTER';
			$PageMainTitle = 'Register';
            break;
		
		// Spin system
		case("spin"):
            $PageURL = '/pages/account/spin.php';
			$TopTitle = 'SPIN';
			$PageMainTitle = 'Spin';
        break;
		
		// Spin system
		case("treasure"):
            $PageURL = '/pages/account/treasure-box.php';
			$TopTitle = 'TREASURE BOX';
			$PageMainTitle = 'Treasure box';
        break;
			
		// chars
        case("profile" && ($getSup == "charid")):
            $PageURL = '/pages/chars/chars.php';
			if ((int)$getThird){$CharName16 = $sql->CharName($getThird);}
			$OtherTitle = $CharName16;
			$TopTitle = 'PROFILE '.$OtherTitle.'';
			$PageMainTitle = 'Profile';
        break;
		
		//CharsPanel
		case("chars" && ($getSup == "manage")):
            $PageURL = '/pages/chars/panel/panel.php';
			$TopTitle = 'CHARACTERS PANEL';
			$PageMainTitle = 'Character Panel';
		break;
		
		// Guilds
        case("profile" && ($getSup == "guild")):
            $PageURL = '/pages/guild/guild.php';
			if ((int)$getThird){ $GuildName = $sql->GuildName($getThird);}
			$OtherTitle = $GuildName;
			$TopTitle = 'GUILD '.$OtherTitle.'';
			$PageMainTitle = 'Guild profile';
        break;
		
		// Web Shop
        case("shop"):
            $PageURL = '/pages/web-shop/shop.php';
			$TopTitle = 'WEB SHOP';
			$PageMainTitle = 'Web shop';
			$HeaderStatus = 'display';
        break;
		
		// Alchemy
        case("alchemy"):
            $PageURL = '/pages/alchemy/alchemy.php';
			$TopTitle = 'ALCHEMY';
			$PageMainTitle = 'Alchemy';
        break;
		
		// Alchemy item
        case("alchemyitem"):
           require_once __DIR__ . "/pages/alchemy/alchemy-item.php";
			exit;
        break;
		
		// Alchemy pages
        case("alchemypages"):
			require_once __DIR__ . "/pages/alchemy/alchemy-pages.php";
			exit;
        break;
		
		// Alchemy action
        case("alchemyaction"):
           require_once __DIR__ . "/pages/alchemy/alchemy-action.php";
			exit;
        break;
		
		//web shop
        case("webshop"):
            require_once __DIR__ . "/pages/web-shop/shop-sections.php";
			exit;
        break;
		
		//web shop
        case("adminshop"):
            require_once __DIR__ . "/pages/ajax-confirm/admin/shop/shop.php";
			exit;
        break;
		
		//web shop
        case("shopaction"):
            require_once __DIR__ . "/pages/ajax-confirm/shop/shop.php";
			exit;
        break;
		
		// Ticket system
		case("admin" && ($getSup == "holla")):
            $PageURL = '/pages/account/ticket-system/admin-tickets.php';
			$TopTitle = 'ALL TICKETS';
			$PageMainTitle = 'Show tickets';
        break;
		
		// chart
		case("statics"):
            $PageURL = '/pages/account/chart.php';
			$TopTitle = 'STATICS';
			$PageMainTitle = 'Statics';
        break;
		
		
		/********** RANKING *********/
		// main page
        case("ranking"):
            $PageURL = '/pages/ranking/main-rank.php';
			$PageMainTitle = 'Ranking';
			$TopTitle= 'RANKING';
		break;
		
		// Player Rank
		case("playerrank"):
			require_once __DIR__ . "/pages/ranking/player.php";
			exit;
		break;
		
		// ranks
        case("guildrank"):
            require_once __DIR__ . "/pages/ranking/guild.php";
			exit;
	    break;
		
		/****************************/

		// Account change systems
		case("account" && ($getSup == "change")):
			require_once __DIR__ . "/pages/ajax-confirm/account/account-change.php";
			exit;
        break;
		
		//Submit forms
        case("loginconfirm"):
            require_once __DIR__ . "/pages/ajax-confirm/login.php";
			exit;
        break;
		
		case("testform"):
            require_once __DIR__ . "/pages/php/test.php";
			exit;
        break;
			
		case("guess"):
            require_once __DIR__ . "/pages/ajax-confirm/guess.php";
			exit;
        break;
		case("regform"):
            require_once __DIR__ . "/pages/ajax-confirm/register.php";
			exit;
        break;
		
		case("regconfirm"):
            require_once __DIR__ . "/pages/ajax-confirm/register.php";
			exit;
        break;
		
		case("firstlogin"):
            require_once __DIR__ . "/pages/ajax-confirm/Firstlogin.php";
			exit;
        break;
		
		case("formreply"):
            require_once __DIR__ . "/pages/ajax-confirm/form-comment.php";
			exit;
        break;
		
		case("mailer"):
            require_once __DIR__ . "/pages/ajax-confirm/re-captcha.php";
			exit;
        break;
		
		case("notification"):
            require_once __DIR__ . "/pages/ajax-confirm/notification.php";
			exit;
        break;
		
		/** Chat **/
		case("mainchat"):
            require_once __DIR__ . "/pages/ajax-confirm/chat.php";
			exit;
        break;
		
		/** Stall Section **/
		case("webstall"):
            require_once __DIR__ . "/pages/ajax-confirm/webstall.php";
			exit;
        break;
		
		case("stallchar"):
            require_once __DIR__ . "/pages/stall/char-item.php";
			exit;
        break;
		
		case("mainstall"):
            require_once __DIR__ . "/pages/stall/main.php";
			exit;
        break;
		
		case("stalldelete"):
            require_once __DIR__ . "/pages/stall/stall-manage.php";
			exit;
        break;
		
		case("ticket"):
            require_once __DIR__ . "/pages/ajax-confirm/ticket.php";
			exit;
        break;
		
		case("spinreward"):
            require_once __DIR__ . "/pages/ajax-confirm/spin-reward.php";
			exit;
        break;
		/**** Chars Section ***/
		case("charinv"):
			require_once __DIR__ . "/pages/chars/Inventory.php";
			exit;
        break;
		case("gamestroage"):
			require_once __DIR__ . "/pages/account/panel/stroages/stroage.php";
			exit;
        break;
		case("charavataritem"):
			require_once __DIR__ . "/pages/chars/Avatar-item-inv.php";
			exit;
        break;
		
		case("webstroage"):
            require_once __DIR__ . "/pages/ajax-confirm/web-bank.php";
			exit;
        break;
		
		//Ranking section
		case("signature"):
			require_once __DIR__ . "/pages/chars/signature.php";
		break;
		
		
		
	    
		//logout case
        case("logout"):
            session_destroy();
            $func->userRedirect('/', false);
            break;
        
		//Page not found
        default:
            $PageURL = '/pages/others/404.php';
			$TopTitle= 'PAGE NOT FOUND';
			$HeaderStatus= 'display';
            break;
        }
    }


      
	    //MainPage
		if(!$_GET){
			$PageURL = '/pages/news/news.php';
			$TopTitle = 'HOME PAGE';
		}
        //head
		include_once __DIR__ . '/pages/basics/head.php';
		
		//nav bar
		include_once __DIR__ . '/pages/basics/top-header.php';
		include_once __DIR__ . '/pages/basics/header.php';
		
		//slider
		if (!$_GET){
			include_once __DIR__ . '/pages/basics/slider.php';
		} else {
			include_once __DIR__ . '/pages/basics/xs-slider.php';
		}

		//pages
		include_once __DIR__ . ''.$PageURL.'';

		//Show RevSlider and Underbar
		if (!$_GET){
			include_once __DIR__ . '/pages/basics/under-bar.php';
		}
		
		//footer
		include_once __DIR__ . '/pages/basics/footer.php';
		
		//hidden items
		include_once __DIR__ . '/pages/basics/others.php';
		
		//end
	    include_once __DIR__ . '/pages/basics/end.php';
		
		}else {
			//beta
			include_once __DIR__ . '/pages/beta/beta.php';
		} 

