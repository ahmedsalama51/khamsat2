-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2016 at 04:44 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `khamsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_unique` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(7, 'Politics', '2016-05-07 22:00:00', '2016-05-07 22:00:00'),
(8, 'Articales', '2016-05-08 18:50:45', '2016-05-08 18:50:45'),
(9, 'World', '2016-05-08 18:53:30', '2016-05-08 18:53:30'),
(10, 'Bussines', '2016-05-08 18:54:15', '2016-05-08 18:54:15'),
(11, 'Tech', '2016-05-08 18:54:33', '2016-05-08 18:54:33'),
(12, 'LifeStyle', '2016-05-08 18:54:47', '2016-05-08 18:54:47'),
(13, 'Sports', '2016-05-08 18:55:00', '2016-05-08 18:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `post_id`, `user_id`, `parent_id`, `created_at`, `updated_at`, `user_token`) VALUES
(50, 'this is first comment', 115, 10, NULL, '2016-05-25 23:48:36', '2016-05-25 23:48:36', 'Okjnl1eDtBOByE2mDF5wbMix9X8YcJa1ofF3w8KLl4WgGP1fWcPrG1Ujik8N'),
(51, 'this is second comment after edit ', 115, 1, NULL, '2016-05-25 23:48:56', '2016-05-26 01:36:54', 'DonB98LKqGgRxbMmjjC864QPG1aKQA9ngOqjeOWQI5P5nISIFBHEbrHngT7U'),
(58, 'this is also comment', 115, 1, NULL, '2016-05-26 01:30:06', '2016-05-26 01:30:06', 'DonB98LKqGgRxbMmjjC864QPG1aKQA9ngOqjeOWQI5P5nISIFBHEbrHngT7U');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_05_24_044329_add_token_to_users_table', 1),
('2016_05_24_050323_add_userTokken_to_posts', 2),
('2016_05_24_052424_add_confirmed_to_users', 3),
('2016_05_24_225717_create_comments_table', 4),
('2016_05_24_230847_add_post_to_comments_table', 5),
('2016_05_24_232624_create_comments_table', 6),
('2016_05_25_001616_add_usercode_to_comments', 7),
('2016_05_26_014034_add_userdatiels_to_comments', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `posted_date` datetime NOT NULL,
  `views_num` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_title_unique` (`title`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_category_id_foreign` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=117 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `content`, `posted_date`, `views_num`, `user_id`, `category_id`, `is_published`, `created_at`, `updated_at`, `user_token`) VALUES
(98, 'The GOP’s electoral-map problem is not about Trump', 'Donald Trump’s victory last week in Indiana’s primary not only effectively sealed the GOP nomination for the real estate billionaire but also brought ', '/post_pictures/The GOP’s electoral-map problem is not about Trump.jpg', 'Republicans have a major electoral-map problem in November. Major.\r\n\r\nDonald Trump’s victory last week in Indiana’s primary not only effectively sealed the GOP nomination for the real estate billionaire but also brought into sharp relief how difficult it will be for any Republican to get to 270 electoral votes and beat Hillary Clinton to become the 45th president this fall.\r\n\r\nStart here: Eighteen states plus the District of Columbia have voted for the Democratic presidential nominee in every election between 1992 and 2012. Add them up, and you get 242 electoral votes.\r\n\r\nBy contrast, 13 states have voted for the Republican presidential nominee in each of the past six elections. Total them up and you get 102 electoral votes.\r\n\r\nThere are two important takeaways from these facts: The generic Democratic nominee starts with an electoral vote lead of 140, and the Democratic nominee needs to find only 28 votes beyond that reliable base to win the presidency.\r\n', '2016-02-05 18:12:00', 3, 7, 7, 1, '2016-05-08 19:21:58', '2016-05-08 20:17:11', ''),
(100, ' The year of the hated: Clinton and Trump, two intensely disliked candidates, begin their face-off', 'In the end, it was the voters of Indiana last week who effectively gave the country the outcome that had loomed for months. The 2016 election will lik', '/post_pictures/ The year of the hated: Clinton and Trump, two intensely disliked candidates, begin their face-off.jpg', 'In the end, it was the voters of Indiana last week who effectively gave the country the outcome that had loomed for months. The 2016 election will likely put Hillary Clinton, who is disliked by a majority of voters, against Donald Trump, disliked by another and more intense majority of voters.\r\n\r\nIf the rise of Trump has no obvious precedent, neither does an election like this. Clinton, whose buoyant favorable ratings in the State Department convinced some Democrats that she could win easily, is now viewed as unfavorably as George W. Bush was in his close 2004 reelection bid. Trump is even less liked, with negative ratings among nonwhite voters not seen since the 1964 campaign of Barry Goldwater.\r\n\r\n“In the history of polling, we’ve basically never had a candidate viewed negatively by half of the electorate,” wrote Sen. Ben Sasse (R-Neb.) in a widely shared note that asked someone, anyone, to mount a third-party run. “There are dumpster fires in my town more popular than these two ‘leaders.’ ”\r\n\r\n[Trump spurs', '2016-03-04 16:01:00', 3, 8, 7, 1, '2016-05-08 19:25:52', '2016-05-24 10:02:25', ''),
(101, 'Simplest Strawberry Tart', ' It''s an ideal vehicle for the ripest strawberries at the height of the season, a dessert that makes more of a splash than just serving berries and cr', '/post_pictures/Simplest Strawberry Tart.jpg', 'This gorgeous tart is adapted from "Sweeter Off the Vine," by Yossy Arefi, a cookbook of fruit desserts for every season. It''s an ideal vehicle for the ripest strawberries at the height of the season, a dessert that makes more of a splash than just serving berries and cream but still has that simple charm. The only tricky part is the crust, which could crack as you transfer it to a serving board. But if that happens, don''t despair. It''s meant to be effortlessly loose and casual, and you can cover the damage with swirls of mascarpone and a blanket of berries.\r\n\r\nPrepare the crust: Whisk the flours and salt together in a large bowl. Combine apple cider vinegar with 5 tablespoons ice water.\r\nWorking quickly, add butter to the flour mixture and toss to coat. Use your fingers or the palms of your hands to press each cube of butter into the flour, ensuring that each butter piece gets coated, until the mixture resembles coarse meal with some pea-size lumps. If at any time the butter seems warm or soft, briefly refri', '2016-03-30 16:01:00', 2, 15, 12, 1, '2016-05-08 19:29:40', '2016-05-09 07:57:26', ''),
(102, 'Chocolate Caramel Tart', 'that desserts in which salt plays a starring role was once a newfangled concept. This recipe, an adaptation of one attributed to the pastry chef Claud', '/post_pictures/Chocolate Caramel Tart.jpg', 'It is hard to believe in this day and age – when salted caramel ice cream is almost as ubiquitous as vanilla – that desserts in which salt plays a starring role was once a newfangled concept. This recipe, an adaptation of one attributed to the pastry chef Claudia Fleming, came to The Times in a 2000 article by Amanda Hesser about the development of that very trend, and it is a perfect example of how it''s done right. Layers of silky caramel and dark chocolate ganache topped with a sprinkling of crunchy, snow-white fleur de sel make this an unforgettable combination of flavors and textures.\r\n\r\nPrepare chocolate dough: In bowl of an electric mixer, combine the butter, confectioners'' sugar and cocoa. Beat until smooth. Add egg yolk and vanilla, and beat until blended.\r\nSift flour into dough mixture. Beat on low speed until combined. Press the dough into the bottom and up the sides of a 10-inch tart pan. (You can use a 9-inch pan, but the crust will be thicker and the caramel may take longer to set in step 4.)\r\nPr', '2015-10-29 22:58:00', 1, 15, 12, 1, '2016-05-08 19:31:41', '2016-05-08 19:39:40', ''),
(103, 'Chocolate Coconut Pecan Tart', 'This dessert adds coconut and pecans to a buttery chocolate shortbread crust, which is baked it until the whole thing is glossy and crisp on top. It t', '/post_pictures/Chocolate Coconut Pecan Tart.jpg', '\r\nIn the bowl of an electric mixer, cream together 8 tablespoons butter and the confectioner''s sugar. Beat in the yolk until combined, then beat in the vanilla. Sift together the flour, cocoa powder and 1/8 teaspoon salt. With the mixer running on low, beat in the dry ingredients until just combined. Scrape the dough into a ball and flatten into a disc. Cover with plastic wrap and chill 1 hour.\r\nOn a lightly floured surface, roll the dough into an 11-inch round. Transfer to a 10-inch fluted tart pan. Chill 30 minutes.\r\nHeat the oven to 325 degrees. Line the crust with foil or parchment paper and fill with pie weights. Bake 15 minutes; remove weights and foil and return crust to the oven to bake until dry to the touch, 5 to 10 minutes more. Cool.\r\nMelt the remaining stick of butter. In a bowl, combine butter, honey, cream, brown sugar, egg, bourbon and 1/8 teaspoon salt. Stir in the coconut and pecans. Pour filling into the crust. Bake until the top is golden brown and the filling is gently set, 35 to 45 minut', '2016-04-29 14:01:00', 1, 15, 12, 1, '2016-05-08 19:42:09', '2016-05-08 19:47:15', ''),
(104, 'Dark Chocolate Pudding', 'This rich, creamy confection crosses a classic, American, cornstarch-thickened chocolate pudding with a luxurious French egg-yolk-laden chocolate cust', '/post_pictures/Dark Chocolate Pudding.jpg', '\r\n Save Add to a collection\r\nShare on Facebook\r\nShare on Pinterest\r\nPrint this recipe\r\nMore\r\n \r\nFOOD MELISSA CLARK By Jenny Woodward 2:12\r\nDark Chocolate Pudding\r\nThis rich, creamy confection crosses a classic, American, cornstarch-thickened chocolate pudding with a luxurious French egg-yolk-laden chocolate custard called pot de crème. It has a dense, satiny texture and a fudgelike flavor from the combination of bittersweet chocolate, cocoa powder and brown sugar. Make sure to serve it with either whipped cream or crème fraîche for a cool contrast; crème fraîche has the advantage of also adding tang.\r\n\r\nMore romantic recipes, from dinner for two to chocolate for all, can be found here.\r\n\r\nFeatured in: The Bittersweet Kiss Of Chocolate . \r\n\r\nBittersweet Chocolate, Cocoa Powder, Heavy Cream Cooked  264 ratings  \r\nINGREDIENTS\r\n1 large egg, plus 2 yolks\r\n6 ounces/170 grams bittersweet chocolate, preferably 66 percent to 74 percent cacao, chopped\r\n2 tablespoons/30 grams unsalted butter, softened\r\n1 teaspoon/5 mill', '2016-05-03 16:01:00', 2, 15, 12, 1, '2016-05-08 19:44:00', '2016-05-08 21:02:12', ''),
(105, 'Dark Chocolate and Pomegranate Bark', 'Chocolate bark is the workhorse of homemade holiday gifts, and in Tom Faglon''s version, he scatters fresh pomegranate seeds over the surface, where th', '/post_pictures/Dark Chocolate and Pomegranate Bark.jpg', 'Bittersweet Chocolate, Cocoa Powder, Heavy Cream Cooked  264 ratings  \r\nINGREDIENTS\r\n1 large egg, plus 2 yolks\r\n6 ounces/170 grams bittersweet chocolate, preferably 66 percent to 74 percent cacao, chopped\r\n2 tablespoons/30 grams unsalted butter, softened\r\n1 teaspoon/5 milliliters vanilla extract\r\n2 ½ cups/590 milliliters whole milk\r\n½ cup/120 milliliters heavy cream\r\n⅓ cup/67 grams light or dark brown sugar\r\n2 tablespoons/15 grams unsweetened cocoa powder\r\n2 tablespoons/20 grams cornstarch\r\n¼ teaspoon/2 grams fine sea salt\r\n Whipped cream or crème fraîche, for serving\r\n Chocolate shavings, for garnish (optional)\r\n Flaky sea salt, for garnish (optional)\r\n Nutritional Information\r\nPREPARATION\r\nIn a small heatproof bowl, whisk together egg and yolks. Set aside.\r\nPlace chocolate, butter and vanilla extract in a food processor or blender but don’t turn on.\r\nIn a medium pot, whisk together milk, cream, brown sugar, cocoa, cornstarch and salt until smooth. Bring to a full boil, whisking, and let bubble for 1 to 2 mi', '2015-10-30 14:01:00', 0, 15, 12, 1, '2016-05-08 19:45:56', '2016-05-08 19:46:00', ''),
(106, 'The (Very Lazy) Sunday Routine of Vanessa Bayer of ‘Saturday Night Live’', 'Vanessa Bayer of “Saturday Night Live” doesn’t get home until around 5 a.m. following the show’s weekly live performance and after-party. “A lot of th', '/post_pictures/The (Very Lazy) Sunday Routine of Vanessa Bayer of ‘Saturday Night Live’.jpg', 'Vanessa Bayer of “Saturday Night Live” doesn’t get home until around 5 a.m. following the show’s weekly live performance and after-party. “A lot of the time I’ll go to sleep with all of my makeup on,” Ms. Bayer said. The 34-year-old comedian and actress, who played Amy Schumer’s sidekick in the movie “Trainwreck” last summer, grew up in Cleveland and discovered the meaning of “comic relief” while battling leukemia as a teenager. “I don’t know if it made me funnier, but it was so amazing, how it made everything be O.K.,” she said. Ms. Bayer lives in a one-bedroom apartment in a West Village high-rise, by herself. “But I just realized there’s a part of my floor that squeaks,” she said, “so it’s kind of like I have a cute pet.”\r\n\r\nSOFA BOUND I try to get up by 3. I put a sweatshirt on over my PJs and I go down my stairs. It’s like a loft where I live; my bedroom is upstairs. My TV is in an entertainment center. You have to open the doors for the remote to work, so I open those and then I sit down on my couch. I’ll forget my slippers upstairs and I’ll be like, “Ugh! I have to go upstairs to get them.” It’s like eight stairs. But stairs are stairs.\r\n\r\nPhoto\r\n\r\nMs. Bayer said she joined Twitter two years ago, and is “still really into it.” Credit Nicole Craine for The New York Times\r\nTHAT MAKEUP I’ll wash my face because I start to feel like my eyes are stuck together. It’s so much makeup from the show. I usually don’t shower. There’s just no reason.\r\n\r\n‘TOASTED!’ I order food from my couch and I don’t leave my couch again until it comes. I’ll order a bagel. I’ll get really mad because they will forget to toast it. It didn’t happen when I lived further east, near NYU. Those people were really on it. I’d say it takes me a good 10 minutes to get over it. I’ll have a savory or sesame bagel. Sometimes I’ll get a raisin bagel with raisin walnut cream cheese and they’ll use a knife they cut an onion bagel with and then there’s a whole section of the bagel I can’t eat. I usually order coffee with the bagel. My coffee maker isn’t the best, so I like ordering it in. Sometimes the coffee will have spilled onto the bagel, and then of course, you know how upsetting that is.\r\n\r\nPhoto\r\n\r\n“I order food from my couch and I don’t leave my couch again until it comes,” Ms. Bayer said. Credit Nicole Craine for The New York Times\r\nUNREALITY TELEVISION I’ll sit and I’ll watch TV while I’m eating my bagel. It’s stuff I have DVR-ed. “Real Housewives,” stuff on Bravo. I also weirdly watch “General Hospital.” I used to watch it and then I stopped and now I’ve started watching it again. They have a lot of supernatural stuff. I truly love it, but the level of believability is very low. It’s very refreshing. \r\n\r\nAdvertisement\r\n\r\nContinue reading the main story\r\nPRIORITIES I joined Twitter two years ago. I was late to it. So I am still really into it. I’ll make a tweet. Wait, is that what you say? Post a tweet? I’ll post a tweet and then I’ll call my brother and say, “Hey, did you see my tweet?” I won’t talk on the phone too much. It’s usually fun to talk to my parents. I mean, it’s always fun! I don’t want to burn my parents. But I don’t pick up the phone much on Sundays. I like texting with friends, but I find if I am watching TV, I have to focus on the show.\r\n\r\nPhoto\r\n\r\n“I’ll order a bagel,” Ms. Bayer said. “I’ll get really mad because they will forget to toast it.” Credit Nicole Craine for The New York Times\r\nCHECKING THE FRIDGE My fridge is usually pretty empty. If I can get it together to order FreshDirect, I will have some fruit and yogurt in the fridge. But there isn’t a ton of stuff you would cook with. I feel like my parents are going to be very proud of me when they read this.\r\n\r\nNOISES OFF I usually meditate twice a day, Transcendental Meditation. For some reason, I always forget to meditate on Sunday, because it’s such a weird day, and I’ll remember at 5 and meditate for 20 minutes. And it’s great, because I’ll feel like I’m getting something done. Even though I am sitting on the couch.\r\n\r\nDELIVERY At 7 or 8 I decide to order dinner. I try and eat kind of healthy on Sunday nights, to balance out the bagel. Some kind of salad, or sushi sometimes. At dinner, I’ll switch to HBO. I can stay up watching TV so late. The problem is I don’t get tired early because of staying up so late. I might order a snack, popcorn, at 11. Sometimes I’ll order in three times on Sundays. People think New York is crazy and busy, but it’s actually a great place for lazy people to live. You can order microwaveable popcorn! I’ll order, like, those bags of it. But there’s a minimum, so then I’ll order laundry detergent. I wonder sometimes what the doormen think of me.\r\n\r\nA version of this article appears in print on May 8, 2016, on page MB2 of the New York edition with the headline: Bed. Couch. Takeout. Bed. Order Reprints| Today''s Paper|Subscribe\r\n\r\nContinue ', '2016-05-05 14:01:00', 1, 1, 7, 1, '2016-05-08 19:50:45', '2016-05-08 19:51:08', ''),
(107, 'A Shooting, the Hospital and Then, Months Later, It’s a Homicide', 'Bruce Purdy was shot in the back in the South Bronx last year, leaving him paralyzed from the waist down. He wanted revenge, but instead wound up bein', '/post_pictures/A Shooting, the Hospital and Then, Months Later, It’s a Homicide.jpg', 'The gunshot survivor, frozen from the waist down, a .380-caliber bullet lodged between his left kidney and lowermost rib, lay on a hospital bed looking at mug shots of South Bronx gang members.\r\n\r\nSgt. Michael J. LoPuzzo asked the man whether he could pick out his shooter.\r\n\r\n“Yep,” Bruce Purdy answered, looking spent. Then he handed back the 8 ½-by-11-inch booklet, with 23 photos.\r\n\r\n“Who?”\r\n\r\nMr. Purdy would not say. Soon, he told Sgt. LoPuzzo, the police would hear about a crazy man in a wheelchair shooting the person who had put him there. “Then you’ll know who it was,” Mr. Purdy said.\r\n\r\nThe hospital-bed threat only hinted at Mr. Purdy’s scorn for the system. Raised during a crack plague, he was a child of government institutions — a half-dozen foster homes, a city jail, six state prison facilities, public housing high-rises — who, at 29, had landed at yet another: Lincoln Medical and Mental Health Center, a red brick monument to both well-honed emergency treatment and overburdened recovery care where most gunshot victims in the South Bronx are taken.\r\n\r\nDetectives began to make regular trips to Mr. Purdy’s bedside in Room 6C at the hospital after the shooting in October. But he was unswayed: Having been robbed of sex and the use of his legs, he said, all he had to look forward to was getting revenge.\r\n\r\nAdvertisement\r\n\r\nContinue reading the main story\r\nThen one night in December, a week after Mr. Purdy had left the hospital against doctors’ orders with little more than a basic wheelchair, he fell short of breath, was picked up by an ambulance and, in the same emergency room that had tended to his gunshot wound, died of a blood clot. A three-month investigation by the New York City medical examiner traced the fatal clot to the shooting, and on March 14, Mr. Purdy’s death was added to this year’s homicide tally for the 40th Precinct, a section of the South Bronx where violence takes diverse paths to death.\r\n\r\nTo understand what drives such violence, The New York Times is documenting each murder logged in the 40th Precinct this year. The killing of Mr. Purdy counted as the fourth homicide there; two more have since been recorded, making the 40th the third-deadliest precinct in New York City in 2016.\r\n\r\nMr. Purdy’s murder is perhaps the precinct’s truest mystery this year. The killer remains on the loose, the beneficiary of a lack of cameras outside the public housing building near where Mr. Purdy was shot and a reluctance on the part of his companions and other witnesses to cooperate with the police. He carried his silence to the grave.\r\n\r\nBeyond the detectives, Mr. Purdy also gave up on Lincoln Medical Center in his last weeks. He resisted physical therapy. He told relatives he had been left to lie for hours in his own excrement. He lit his bedsheets on fire, and cursed and yelled at doctors to send him home.', '2016-03-05 12:01:00', 0, 1, 7, 0, '2016-05-08 19:54:32', '2016-05-08 19:54:32', ''),
(108, 'What Makes Texas Texas', 'Those are some of the most potent words in the state’s vocabulary: Texas-made. In a cupboard in our home here, we had a bottle of 1835, a bourbon bott', '/post_pictures/What Makes Texas Texas.jpg', 'HOUSTON — Gov. Greg Abbott’s campaign sent me an email one morning, showing the governor aiming a pump-action shotgun in my direction. This was a view of an elected official I had never seen — the get-your-hands-up view. If I contributed $25 to his campaign, I would be entered in a contest to win a shotgun. The subject line of the email read: “Shotgun!” It was a typical morning in Texas.\r\n\r\nThe prize was special, though. It was not a rare antique. It was, the email noted three times, a Texas-made shotgun.\r\n\r\nThose are some of the most potent words in the state’s vocabulary: Texas-made. In a cupboard in our home here, we had a bottle of 1835, a bourbon bottled in Texas and named for the year of the first battle for Texas independence. My crunchy peanut butter is made with Texas-grown peanuts. My salsa of choice is Native Texan (“Born in Texas, Never Leavin’ Texas”). I am not sure where our minivan was made, but as I idle at red lights I know the heritage of the Toyota Tundra in front of me. The stickers on the pickup trucks, built in San Antonio, declare: “Born in Texas, Built by Texans.”\r\n\r\nINTERACTIVE FEATURE\r\nThe Lone Star List\r\nTwelve events, moments and places that make Texas Texas.\r\n\r\n\r\n OPEN INTERACTIVE FEATURE\r\nI was born and raised in Central California, and I moved to Houston from Brooklyn in June 2011 to cover Texas for The New York Times. I live here with my wife, my 7-year-old son and my 3-year-old daughter, who keeps a pair of pink cowboy boots outside on the porch or inside by the front door. I have covered stories in the South, the Midwest and other parts of the country. People in those places identified with their political party, their job, their cause, their sexual orientation, their city, their race. Almost no one identified with their state the way Texans do.\r\n\r\nWho are these people, these Texans? What do they tell us about America? What to make of a state that is so focused on itself? I wrestle with these questions all the time.\r\n\r\nAdvertisement\r\n\r\nContinue reading the main story\r\nOne day, behind a general store in Central Texas, a firearms instructor in a wide-brimmed cowboy hat reached for the butt of his holstered gun as I approached him for an interview. The general store, the hat, the reach for the gun: the line between the myth of Texas and the reality of Texas is razor thin.\r\nI have met Texas Rangers who actually do seem larger than life and artists and writers who have taken the state’s entrepreneurial energies in entirely cool directions. I’ve met conspiracy theorists, Texas secessionists and Texas nationalists (there is a difference), as well as those in the parallel and wholly separate Texas made up of the uninsured, the undocumented, the imprisoned and the poor. Much of it is not my world, but despite that — or perhaps because of it — I think I’m becoming a little bit Texan. The historian T. R. Fehrenbach once wrote that Texas “shaped those who lived upon it more than they changed it.”\r\n\r\nYou don’t just move to Texas. It moves into you.\r\n\r\nMy life as a Texan is exactly what you might imagine it would be. The other day, I crawled around the bathroom floor trying to catch a palm-size green anole lizard that had sneaked into the house. I spent a recent weekend at the Houston Livestock Show and Rodeo, eating Frito pie and watching the piglet races with my children. My son stands every morning in his classroom and recites the Pledge of Allegiance to the American flag. And then he makes another pledge to the Texas flag, in accordance with Section 25.082 of the Texas Education Code, which requires all children in public schools to recite the two pledges. It is not some vestige of the late 1800s: The law was passed by the Texas Legislature in 2003.\r\n\r\nAbout a month after I moved here, a 41-year-old man named Mark Stroman told Texas that he loved Texas, just before Texas killed him. As he lay on the gurney in the state’s execution chamber, Mr. Stroman, a convicted murderer who had an eighth-grade education and was a native Texan, uttered as part of his last statement, “Texas loud, Texas proud.” It was a jaw-dropping moment that set a theme for me. After nearly five years in Texas, the theme has only intensified: the metamorphosis of Texas, the country’s second-most populous state, into ultra-Texas, of a singular state into a singular superstate.\r\n\r\nAssignment America\r\nThis article is part of a series exploring changes in American politics, culture and technology, drawing on the reporting and personal experiences of New York Times journalists around the country.\r\n\r\n\r\n• Little Havana, by Lizette Alvarez\r\nThe Miami neighborhood has shaped thousands of Cuban immigrants or their children into success stories, from Marco Rubio to the rapper Pitbull. But a reporter who grew up there fears its demise.\r\n\r\n• Sandpoint, Idaho, by Kirk Johnson\r\nThrough grit and persistence, the center is holding in this Western small town, against forces that are turning other hamlets into ghost towns.\r\n\r\n• Selma, Ala., by Gay Talese Fifty years after the police viciously attacked hundreds of marchers in a pivotal moment of the civil rights movement, Selma, Ala., defies neat story lines.\r\n“I think part of the reason Texas is having a moment is because it’s being more itself than it’s ever been,” said Stephen Harrigan, a novelist and essayist in Austin who is writing a history of the state. “It’s Texas unchained, in a way.”\r\n\r\nTexas, of course, comes by its sense of being a place apart honestly: From 1836-1845, it was its own country, the Republic of Texas, and it has long feasted on hyperbole. But these days Texas does feel increasingly like a caricature of a caricature.\r\n\r\nTexas has long had an anti-Washington streak, but, lest anyone doubt it, the state has sued the federal government more than 40 times in the past 13 years. In December, an executive committee of the Republican Party of Texas approved a resolution supporting secession and calling for the issue to be put to voters statewide. (Party leaders struck down the resolution after a heated debate.)', '2016-02-02 14:00:00', 2, 1, 7, 1, '2016-05-08 19:56:47', '2016-05-08 21:05:20', ''),
(109, 'In England, the Premier League Is Turned Upside Down', 'BIRMINGHAM, England — At the end of each season’s final home game, the tradition goes, the players and staff at Aston Villa walk around the entire fie', '/post_pictures/In England, the Premier League Is Turned Upside Down.jpg', 'BIRMINGHAM, England — At the end of each season’s final home game, the tradition goes, the players and staff at Aston Villa walk around the entire field in a slow processional. The so-called lap of appreciation, which is done by other clubs, too, is a way for the team and fans to applaud each other one more time before summer.\r\n\r\nThe circuit is often emotional (such as in 2013, when Stiliyan Petrov led the team after announcing his retirement because of leukemia treatment), and it is almost always warm: Last spring, Fabian Delph, the team captain, carried his infant daughter, who wore a claret-and-blue jersey with “Daddy” written on her back and giggled for much of the ride.\r\n\r\nThis season, however, there was more concern about the lap than excitement. Would the reception be nasty? Violent? Just plain sad? While Leicester City’s fans partied in an endless — if somewhat surreal — championship celebration just up the road on Saturday, the mood at Villa Park, with fellow bottom-scrapers Newcastle United in town, was grim.\r\n\r\nA bloc of fans marched in protest before the match. Spectators in the stadium batted around hundreds of beach balls (and other, more anatomically graphic, inflatables) during the game in another show of discontent. Several home players were booed whenever they touched the ball. When rain arrived in the second half, many spectators simply gave up and left early. If Leicester is the small club that improbably hit it big in this season of seasons, Aston Villa, in last place and suffering a wretched campaign, is the big club that has somehow plummeted to unthinkable depths.\r\n\r\nIn some ways, the numbers are as staggering as Leicester’s. The Villans have won three games all year, equal to the number of managers they have had. They have a goal differential of minus-45. They have scored just 27 times, which is the same number of goals that the Tottenham star Harry Kane has scored by himself.\r\n\r\nPhoto\r\n\r\nLeicester City celebrated its improbable Premier League title. Credit Matt Dunham/Associated Press\r\nAll of that would be bad enough at any club, but Aston Villa — and Newcastle, frankly, which did not exactly cover itself in glory during a hide-your-eyes 0-0 draw and will very likely be relegated as well — is one of England’s most storied organizations.\r\n\r\nSo, no, this has not been Derby County recording 11 points and getting torched throughout the 2007-8 season; Aston Villa has won the country’s top division seven times, claimed the European Cup in 1982, competed for a Champions League spot as recently as 2009 and plays in a grand stadium that seats nearly 43,000. It has not been relegated in nearly three decades. Its performance this season ranks among the most disappointing in English soccer history.\r\n\r\nAdding to the sting is the juxtaposition of Leicester’s rise. The Foxes had a jubilee Saturday, with fans roaming outside King Power Stadium for hours, drinking and chanting and singing and smiling, before going inside and hearing the tenor Andrea Bocelli deliver a stirring prematch performance that was followed by the players’ walking through an honor guard as they entered the field. Oversize banners rolled through the crowd. After the match, the Premier League trophy was raised for the first time in team history, and a mostly middling club with a Thai owner and little history of success had the cap on a season in which it beat just about everyone, big and small.\r\n\r\nOnly 45 miles, 20 wins and about 40 goals away was Aston Villa. While Leicester’s ascent was relatively sudden — it was nearly relegated last year and shot up to first place from 14th — the Villans tumble from near the treetops has been slow, steady and brutal, with this year’s showing being the rough equivalent to smacking square into one final branch on the way down.\r\n\r\nTheories abound regarding what, exactly, was the tipping point, but many Villa observers point to the actions of the American owner, Randy Lerner, who poured money into the club shortly after buying it in 2006 only to switch to constant cost-cutting a few years later.\r\n\r\nYet money is only part of it. Aston Villa has had plenty of pricey player failures, with the French international Charles N’Zogbia, who is earning is about $91,000 a week but is mostly training with the club’s reserves, among the most notable. It has had internal battles, such as when a former manager, Martin O’Neill, resigned because he felt Lerner was not supporting him. It has had bad luck, like when Gérard Houllier had to step down as coach because of medical issues. And it has had, some fans believe, cosmic comeuppance for disrupting the natural order of things when, in 2011, Lerner inexplicably asked Alex McLeish, who had just finished coaching the bitter rivals Birmingham City, to come lead Villa. (McLeish lasted a year.)\r\n\r\nSports Newsletter\r\nGet the big sports news, highlights and analysis from Times journalists, with distinctive takes on games and some behind-the-scenes surprises, delivered to your inbox every week.\r\n\r\n\r\nAll of it led to this season’s nightmare, which began, somewhat bizarrely, with a victory. Aston Villa beat Bournemouth in its opener last August, a result that made the following nine-game winless streak (and subsequent firing of the first manager) all the more jarring.\r\n\r\nLeicester won on opening day too, of course, and the clubs diverged ever since. Leicester’s quirks were novel and fun: pizza parties for shutouts, fan noisemakers that were weird but charming, a former nonleague player (Jamie Vardy) who suddenly morphed into the country’s most dangerous scorer. Aston Villa’s moves, meanwhile, were toxic: a strange managerial hire in Remi Garde, who lasted 20 games; a series of protests from befuddled fans; a scandal involving the veteran captain Gabriel Agbonlahor, who was, among other things, photographed out partying on the night the Villans were officially relegated last month.\r\n\r\nNext season, they will play in the second division for the first time since 1987. Scarves were on sale outside Villa Park on Saturday that read, “This club is our love whatever the division,” and there is no doubt the fans here are committed. Attendance will very likely remain strong.\r\n\r\nBut the Villa fans are also unyielding, and that is why the players did little more than the typical quick clap toward the stands before vacating the field at the final whistle. There was no lingering, no celebration. After the last home game of the season, there was no lap of honor here on Saturday.\r\n\r\n\r\n8\r\nCOMMENTS\r\nIt made sense, really. After consulting with fan groups during the week, the club made its best decisions in some time.\r\n', '2016-05-05 14:01:00', 4, 14, 13, 1, '2016-05-08 20:00:35', '2016-05-09 07:57:36', ''),
(110, 'After a Round With the Widowmaker, a Golfer Enjoys a More Familiar Grind', 'CHARLOTTE, N.C. — “I’m not going anywhere,” Jason Bohn told his caddie on Friday as he rummaged through his golf bag outside the Quail Hollow clubhous', '/post_pictures/After a Round With the Widowmaker, a Golfer Enjoys a More Familiar Grind.jpg', 'CHARLOTTE, N.C. — “I’m not going anywhere,” Jason Bohn told his caddie on Friday as he rummaged through his golf bag outside the Quail Hollow clubhouse. “I’m planning to stick around for a while.”\r\n\r\nBohn was referring to his plans in the immediate aftermath of a missed cut at the Wells Fargo Championship, but he might have been talking about his long-term prognosis after a heart attack at the Honda Classic in February.\r\n\r\nAs chilling as it is for Bohn to consider, if he had failed to make the cut at the Honda at the end of February, he very likely would not have survived to celebrate his 43rd birthday on April 24. He said that had he not parred the last four holes at PGA National, a treacherous stretch, to make the cut with no strokes to spare, he would have showered, packed his suitcase, checked out of his room at the on-site hotel and headed to the airport for the next flight to Atlanta, where he lives in the suburbs with his wife, Tewana, and their sons, Conner and Cameron.\r\n\r\n“I would have never gotten checked out if I hadn’t made the cut,” Bohn said. “I just didn’t think it was severe enough.”\r\n\r\nBut with two more rounds ahead of him, Bohn asked to see a doctor, hoping for an infusion of energy. He expected to be sent on his way after receiving an antibiotic for the bronchitis that had laid him low the week before. But when the paramedics arrived at his side and looked at an electrocardiogram, they said they needed to get him to the hospital posthaste. Further testing at the catheterization laboratory at Palm Beach Gardens Medical Center revealed that Bohn’s left anterior descending artery, commonly known as the widowmaker, was 99 percent blocked.\r\n\r\nThe next day, instead of playing his third round, Bohn underwent a procedure in which a stent was used to open his blocked artery. After a six-week convalescence, Bohn, a two-time PGA Tour winner, returned and has made one cut in three starts.\r\n\r\nPhoto\r\n\r\nJason Bohn at the RBC Heritage. His health scare might have indirectly saved his mother’s life. Credit Streeter Lecka/Getty Images\r\n“My physicians said that if I hadn’t asked for a doctor, I probably would have died either in the hotel room or on the plane,” Bohn said. “You hear of people saying, ‘Oh, I don’t feel real well, I’m just going to go lay down,’ and then they never wake up. That’s kind of the position I was in.”\r\n\r\nContinue reading the main story\r\n\r\nRELATED COVERAGE\r\n\r\n\r\nON GOLF\r\nGolf’s Schedule Takes the Sheen Off Olympic Gold MAY 4, 2016\r\n\r\nBrian Stuard Wins Zurich Classic in a Playoff MAY 2, 2016\r\nIn retrospect, Bohn said, he should have known his heart might be a ticking bomb. After his first round of the Honda Classic, he experienced a tightness in his chest that caused him to type “chest pressure” in a Google search. He stopped scanning the results when his eyes fell on what he thought was the most plausible explanation. “It said when bronchitis turns to pneumonia there can be that sensation of pressure in your chest,” Bohn said. “I didn’t notice anything about a heart attack.”\r\n\r\nThen again, you do not see what you are not looking for. His family had no history of heart disease, Bohn said. Or so they thought. After his hospitalization, Bohn’s 72-year-old mother, Carol, decided to move up her annual checkup. She has a healthy diet and an exercise regimen that includes daily walks.\r\n\r\n“She’s the last person you’d expect to have anything wrong with her heart,” Bohn said.\r\n\r\nHis mother had an EKG and an echocardiogram. Neither showed any abnormalities. Her doctor recommended an exercise stress test, which she completed the week her son returned to competition at the RBC Heritage in Hilton Head Island, S.C.\r\n\r\nBohn had just grinded to shoot a 69 to make the cut when he received a call from his mother. “She said, ‘I’m in the hospital, my doctors are saying I have a lot of blockage,’ ” he said. Three days later, Bohn’s mother underwent triple bypass surgery.\r\n\r\nBohn became emotional at the thought that his health scare might have indirectly saved his mother’s life.\r\n\r\n“I’d have a heart attack every week to save my mom,” he said.\r\n\r\nSince Bohn’s return to golf, friends and strangers alike have told him that his health scare motivated them to get physicals. His fellow competitors have wrestled with their own mortality.', '2016-03-29 15:01:00', 0, 14, 13, 1, '2016-05-08 20:02:02', '2016-05-08 20:02:19', ''),
(111, 'A Mother’s Lesson: When Memory Fails, Delight in the Moment', 'The first sign that the Alzheimer’s disease that ravaged my grandmother was back for her daughter was when Mom began having trouble saying “CNN.” She’', '/post_pictures/A Mother’s Lesson: When Memory Fails, Delight in the Moment.jpg', 'The first sign that the Alzheimer’s disease that ravaged my grandmother was back for her daughter was when Mom began having trouble saying “CNN.” She’d watched the cable news network for years with ferocious interest ever since returning from a life abroad in the Foreign Service to rural New Hampshire. There she nested in her mother’s house, saying she’d never move.\r\n\r\nIt was a distinctly peaceful life. I’d listen to her play the grand piano — the passion that had taken her to Juilliard decades earlier — and marvel at the lightness of her hands on the keys. On Sundays, she was the favorite lector at our church, reading the liturgy with an elegance instilled by her mother and grandmother, both trained elocutionists.\r\n\r\nShe also wrote and recorded essays on country living for NPR on subjects like “Mahler and Macaroni.” Words mattered a great deal to her. She mattered the world to me. I used to say I’d won the lottery when it came to mothers.\r\n\r\nAfter Dad died, my mother continued to live alone in the big white house on the common. It was here in 1988 that she’d written a keenly observed Sunday commentary for this newspaper about her own mother’s battle with aging — and the dementia that “erased her life, line by line.”\r\n\r\nShe wanted me to promise that if her own light dimmed – or as she put it, “when I lose my mind too” – I wouldn’t upend my own life to care for her. But we never came up with a real plan.\r\n\r\nAbout a year after CNN became “C…D…D…” and the home care team we’d improvised announced my mother’s decline was too much for them, my brothers and I barely convinced her to “visit” sunny California where my middle brother lived.\r\n\r\nThat visit became a new “post” in a fancy retirement community where, for $7,500 a month, she had her own studio and bathroom. She enjoyed music events and a stately dining room with a menu. There was even a church on the corner.\r\n\r\nBut like so many living with Alzheimer’s, Mom’s biorhythms were upside down. She’d often sleep during the day and be up all night doing what is known as “exit-seeking.”\r\n\r\nNights are the Achilles heel of most eldercare facilities staffed by the fewest caregivers — and the most inexperienced. Across the country, in many well-meaning Alzheimer’s units, memory care residents are treated with confinement.\r\n\r\nSo Mom “graduated” to the locked Memory Care unit for her “safety.” It broke my heart to watch her on tiptoes, peering through the locked door’s porthole across to the dining room she once enjoyed.\r\n\r\nAlzheimer’s is not a mere matter of Swiss cheese memory and odd behaviors. It is a serious medical condition. It is terminal. It should be known for what it is: Brain Failure.\r\n\r\nOne morning, Mom emerged from her Memory Care room covered with bruises. The police came. The state came. There was even suggestion of a rape kit because my mother, clearly agitated, could say only, “the man, the man.”\r\n\r\nWe will never know what happened. But it stands to reason that if you lock up the most advanced Alzheimer’s residents with their attendant behavioral disorders, and apply nominal supervision, well, something is bound to happen. On the night in question, one newly hired caregiver attended 17 residents.\r\n\r\nSo we moved her again, this time to Seattle, close to my eldest brother and me, thereby violating the cardinal rule of Alzheimer’s care: thou shalt not move the patient. Change registers a full 10 on the Alzheimer’s Richter scale. The more Mom’s brain failed, the more I twirled to try to make things better.\r\n\r\nWithin a matter of weeks in the new place, she had fallen and broken her hip. Surgery followed, then three months in a rehab facility, and finally a move to a small adult family home with just six residents. She was exhausted and utterly disoriented. I was a wreck.\r\n\r\nStill, I knew I was among the lucky ones. Despite the recent scan that showed her brain a mostly blank white slate, my mother somehow always managed to recognize me during our visits (although she’d begun calling me “Mom.”)\r\n\r\nWhere once I’d thought I’d lose my mind if she asked me the same question one more time, now I prayed to hear any full sentence just one more time. Ever the peripatetic family caregiver, I rarely stopped to inhabit my mother’s world: the one with no past, no future, just the present.\r\n\r\nOn our last Mother’s Day together, I took her to the big morning Mass at St. James Cathedral. As I attempted a Houdini maneuver getting her out of the car, up the curb and down the sidewalk to the church door, she somehow slithered from my grasp.\r\n\r\nMy mother sank to the ground in what seemed like slow motion. She never made a sound. She just lay there in the green grass in her rose-colored tweed suit, brilliant white hair glinting in the spring sun, blue eyes open wide, staring straight up into an unusually cloudless Seattle sky.\r\n\r\nWith church bells pealing through the cool morning air, my beautiful, brilliant mother stretched out her arms and made angel wings in the grass.\r\n\r\nAnd all the doctors and all the medications and all the years of worry that couldn’t bring my mother back together again, also couldn’t defeat the magic of that moment.\r\n\r\nI lay down next to her, threaded my fingers through hers, and for a brief wondrous moment, we held the present.\r\n\r\nMary Claude Foster is a journalist living in Seattle.\r\n', '2015-12-31 23:58:00', 3, 9, 8, 1, '2016-05-08 20:11:00', '2016-05-09 13:21:18', ''),
(112, 'The Weekly Health Quiz: Prince, Food Labels and ‘The Biggest Loser’', 'A study of contestants on “The Biggest Loser” found that the body continued to fight to regain lost weight how long after massive weight loss?', '/post_pictures/The Weekly Health Quiz: Prince, Food Labels and ‘The Biggest Loser’.jpg', 'A study of contestants on “The Biggest Loser” found that the body continued to fight to regain lost weight how long after massive weight loss?\r\n\r\nOne month One year Two years Six years\r\nBalazs Mohai/European Pressphoto Agency\r\nPrince, during a 2011 concert in Budapest. Last month, friends sought urgent medical help, alarmed by his hidden dependency on painkillers.\r\n\r\n2Investigations into the death of Prince continue, but some initial reports suggest the artist may have had an addiction to:\r\n\r\nHeroin Cocaine Prescription painkillers Alcohol\r\nGetty Images\r\n3Young rats genetically prone to obesity were least likely to gain weight as adults if they:\r\n\r\nExercised Ate fewer calories Exercise and diet had roughly equivalent effects on long-term weight gain Exercise and diet had little impact on long-term weight gain\r\n4In 2015, American grocery shoppers were most responsive to this claim on food labels:No fat/low fat\r\n\r\nNo fat/low fat Low sodium No artificial ingredients Certified organic\r\n5Which statement about Alzheimer’s disease is NOT true?\r\n\r\nMore than five million Americans have Alzheimer’s, about two-thirds of them women. The cause of Alzheimer’s is unknown in most cases. About a quarter of people carry the ApoE4 gene, which increases Alzheimer’s risk. All people with mild cognitive impairment eventually develop Alzheimer’s.\r\n6Removal of the ovaries was tied to an increased risk of this form of cancer:\r\n\r\nOvarian cancer Uterine cancer Colon cancer Breast cancer\r\n7Misdiagnoses, medication dosage mistakes and other medical errors may account for this many deaths a year in the United States, a new analysis found:\r\n\r\n100,000 250,000 500,000 1 million\r\n8By age 80, about half of Americans will have this eye condition:\r\n\r\nPresbyopia Amblyopia Macular degeneration Cataracts', '2016-02-02 14:01:00', 1, 9, 8, 1, '2016-05-08 20:13:08', '2016-05-08 21:00:39', '');
INSERT INTO `posts` (`id`, `title`, `description`, `image`, `content`, `posted_date`, `views_num`, `user_id`, `category_id`, `is_published`, `created_at`, `updated_at`, `user_token`) VALUES
(113, 'Yoga for the Showoff. Namaste.', 'Chip Foley has competed in 50 triathlons, but now he’s turning his focus upside down. “My ultimate goal is to be able to do a handstand and hold it fo', '/post_pictures/Yoga for the Showoff. Namaste..jpg', 'To achieve the feat, he is pursuing a rigorous training regimen: attending daily classes at Lyons Den Power Yoga, a studio in TriBeCa that specializes in hot yoga; studying handstand videos on YouTube; and doing core-strengthening exercises at home four or five times a week. “I’m obsessed with it,” said Mr. Foley, 38, who spends his right-side-up time as the owner of a Manhattan-based technology consulting firm.\r\n\r\nWhy the fixation? Social media could be the culprit. Sarah Turk, a lead analyst with IBISWorld, a market research firm, said yoga poses lent themselves to showing off. And Instagram has the numbers to support that statement: The hashtag “yogaeverydamnday” has racked up over five million posts; #handstand and #handstands, over 400,000.\r\n\r\n“There’s a level of badassness to it,” said Metta Murdaya, 41, who has been working on her handstand for the past two years. Ms. Murdaya, co-founder of JUARA Skincare, said her inversion practice made her feel more confident, fearless and focused, which she channels into her work as an entrepreneur.\r\n\r\n“Literally, you succeed because you refuse to fail,” she said.\r\n\r\nThe rise of the inversion comes with the rise of the yoga and Pilates industry in the United States, which brought in an estimated $9.1 billion in 2015, according to an IBISWorld report prepared by Ms. Turk. A Yoga in America study recently found that the number of yoga students increased to 36 million in 2016 from 20.4 million in 2012.\r\n\r\nPhoto\r\nPracticing handstands at Pure Yoga. “You will never be more focused than when you are upside down,” said Kiley Holliday, an instructor.\r\nPracticing handstands at Pure Yoga. “You will never be more focused than when you are upside down,” said Kiley Holliday, an instructor.Credit Nicole Bengiveno/The New York Times\r\nOwners of trendy studios that have cropped up to meet New Yorkers’ demands for new ways to practice yoga, like Lyons Den, Pure Yoga and Y7 Studio, said that they had noticed an uptick in requests for inversion workshops and time devoted to handstands and headstands in class. Y7, which holds yoga classes set to pop and hip-hop music in rooms heated by infrared light, has already held four sold-out, two-hour inversion workshops this year, said Sarah Larson Levey, a founder of the studio.\r\n\r\nPhoto\r\n“There’s a level of badassness to it,” said Metta Murdaya, 41, who has been working on her handstand for the past two years.\r\n“There’s a level of badassness to it,” said Metta Murdaya, 41, who has been working on her handstand for the past two years.Credit Juara Skincare\r\nKiley Holliday, who teaches at Pure Yoga and Equinox in Manhattan, says handstands are popular among her students because of the feeling of accomplishment they experience when they are finally able to do them.\r\n\r\nInversions help students be present in the moment, a perennial objective among yogis, she added. “You will never be more focused than when you are upside down,” Ms. Holliday said. “It is impossible to think of anything else than what you are doing.”\r\n\r\nThe danger, of course, is taking a tumble, which for many is a rite of passage. “We all fall,” said Lauren Abramowitz, 39, founder of Park Avenue Skin Solutions, who has posted pictures of herself online in an advanced-level scorpion pose (a handstand with a backbend). “It’s not a matter of if, it’s how do you get back up.”\r\n\r\nDr. Gregory Galano, an orthopedic surgeon affiliated with Lenox Hill Hospital, said he often saw patients with yoga-related injuries. “Doing repetitive or long-lasting handstands can lead to everything from low-grade wrist sprains and tendinitis to more serious labral tears in the shoulder,” he said.\r\n\r\nHe recommends that people slowly work up to more challenging poses. “You want to do things in a controlled and safe manner,” Dr. Galano said.\r\n\r\nPhoto\r\nInstagram users show off their poses.\r\nInstagram users show off their poses.Credit From left: Melissa Perlzweig, Lauren Abramowitz and Elina Lin\r\nTo that end, the trainer Kira Stokes prepares students for handstands with a variety of core-strengthening moves in her Stoked 360 class at BFX Studio, the studio brand of New York Sports Clubs, owned by Town Sports International. One of her favorite exercises, a pike on a stability ball that involves bringing the hips over the shoulders, also helps improve shoulder stability and balance.\r\n\r\n“It’s more than a good party trick,” Ms. Stokes said of achieving a handstand. “It takes strength, balance, coordination and body awareness — all in one move.” She likes to do them, she said, because the practice “boosts my energy and is great for the circulatory system.”\r\n\r\nFor those who are starting out, just propping your legs against a wall and breathing deeply can give you some of the same energy-boosting benefits, said Sally Melanie Lourenco, a yoga and meditation teacher. “A lot of people aren’t comfortable flipping their world upside down.”\r\n', '2016-05-03 14:00:00', 51, 9, 8, 1, '2016-05-08 20:14:39', '2016-05-25 08:40:47', ''),
(115, 'this is post using user token ', 'i tried to use user remmber token to secure his posts', '/post_pictures/this is post using user token .jpg', '$post->user_token = $user->remember_token;', '2016-05-24 03:02:00', 319, 1, 7, 1, '2016-05-24 02:55:14', '2016-05-26 01:36:49', 'DonB98LKqGgRxbMmjjC864QPG1aKQA9ngOqjeOWQI5P5nISIFBHEbrHngT7U'),
(116, 'another post with token', 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', '/post_pictures/another post with token.jpg', 'any content', '2016-02-02 01:00:00', 0, 1, 7, 0, '2016-05-24 03:05:18', '2016-05-24 03:05:18', 'DonB98LKqGgRxbMmjjC864QPG1aKQA9ngOqjeOWQI5P5nISIFBHEbrHngT7U');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=150 ;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(92, 98, 19, '2016-05-08 19:21:58', NULL),
(93, 98, 20, '2016-05-08 19:21:59', NULL),
(94, 98, 21, '2016-05-08 19:21:59', NULL),
(95, 98, 22, '2016-05-08 19:21:59', NULL),
(96, 98, 23, '2016-05-08 19:21:59', NULL),
(97, 100, 19, '2016-05-08 19:25:52', NULL),
(98, 100, 20, '2016-05-08 19:25:52', NULL),
(99, 100, 21, '2016-05-08 19:25:52', NULL),
(100, 100, 23, '2016-05-08 19:25:52', NULL),
(101, 100, 24, '2016-05-08 19:25:52', NULL),
(102, 101, 25, '2016-05-08 19:29:40', NULL),
(103, 101, 26, '2016-05-08 19:29:40', NULL),
(104, 101, 27, '2016-05-08 19:29:41', NULL),
(105, 102, 25, '2016-05-08 19:31:41', NULL),
(106, 102, 26, '2016-05-08 19:31:41', NULL),
(107, 102, 27, '2016-05-08 19:31:41', NULL),
(108, 103, 25, '2016-05-08 19:42:09', NULL),
(109, 103, 26, '2016-05-08 19:42:09', NULL),
(110, 103, 27, '2016-05-08 19:42:09', NULL),
(111, 104, 25, '2016-05-08 19:44:00', NULL),
(112, 104, 26, '2016-05-08 19:44:00', NULL),
(113, 104, 27, '2016-05-08 19:44:00', NULL),
(114, 105, 25, '2016-05-08 19:45:56', NULL),
(115, 105, 26, '2016-05-08 19:45:56', NULL),
(116, 105, 27, '2016-05-08 19:45:56', NULL),
(117, 106, 28, '2016-05-08 19:50:45', NULL),
(118, 106, 29, '2016-05-08 19:50:45', NULL),
(119, 106, 19, '2016-05-08 19:50:45', NULL),
(120, 107, 30, '2016-05-08 19:54:32', NULL),
(121, 107, 19, '2016-05-08 19:54:32', NULL),
(122, 107, 31, '2016-05-08 19:54:32', NULL),
(123, 108, 19, '2016-05-08 19:56:48', NULL),
(124, 108, 32, '2016-05-08 19:56:48', NULL),
(125, 108, 33, '2016-05-08 19:56:48', NULL),
(126, 109, 34, '2016-05-08 20:00:36', NULL),
(127, 109, 35, '2016-05-08 20:00:36', NULL),
(128, 109, 36, '2016-05-08 20:00:36', NULL),
(129, 109, 37, '2016-05-08 20:00:36', NULL),
(130, 110, 38, '2016-05-08 20:02:02', NULL),
(131, 110, 39, '2016-05-08 20:02:02', NULL),
(132, 110, 19, '2016-05-08 20:02:02', NULL),
(133, 111, 40, '2016-05-08 20:11:00', NULL),
(134, 111, 41, '2016-05-08 20:11:00', NULL),
(135, 111, 42, '2016-05-08 20:11:00', NULL),
(136, 112, 40, '2016-05-08 20:13:08', NULL),
(137, 112, 43, '2016-05-08 20:13:08', NULL),
(138, 113, 40, '2016-05-08 20:14:39', NULL),
(139, 113, 38, '2016-05-08 20:14:39', NULL),
(140, 113, 44, '2016-05-08 20:14:40', NULL),
(141, 113, 45, '2016-05-08 20:14:40', NULL),
(146, 115, 50, '2016-05-24 02:55:14', NULL),
(147, 115, 51, '2016-05-24 02:55:14', NULL),
(148, 116, 50, '2016-05-24 03:05:18', NULL),
(149, 116, 51, '2016-05-24 03:05:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `created_at`, `updated_at`) VALUES
(19, 'America', '2016-05-08 19:21:58', '2016-05-08 19:21:58'),
(20, 'trump', '2016-05-08 19:21:59', '2016-05-08 19:21:59'),
(21, 'WhiteHouse', '2016-05-08 19:21:59', '2016-05-08 19:21:59'),
(22, 'world', '2016-05-08 19:21:59', '2016-05-08 19:21:59'),
(23, 'politices', '2016-05-08 19:21:59', '2016-05-08 19:21:59'),
(24, 'elections', '2016-05-08 19:25:52', '2016-05-08 19:25:52'),
(25, 'tart', '2016-05-08 19:29:40', '2016-05-08 19:29:40'),
(26, 'foods', '2016-05-08 19:29:40', '2016-05-08 19:29:40'),
(27, 'dessert', '2016-05-08 19:29:41', '2016-05-08 19:29:41'),
(28, 'society', '2016-05-08 19:50:45', '2016-05-08 19:50:45'),
(29, 'lazy', '2016-05-08 19:50:45', '2016-05-08 19:50:45'),
(30, 'crimes', '2016-05-08 19:54:32', '2016-05-08 19:54:32'),
(31, 'Accedeniet', '2016-05-08 19:54:32', '2016-05-08 19:54:32'),
(32, 'Texas', '2016-05-08 19:56:48', '2016-05-08 19:56:48'),
(33, 'Fun', '2016-05-08 19:56:48', '2016-05-08 19:56:48'),
(34, 'Premier', '2016-05-08 20:00:36', '2016-05-08 20:00:36'),
(35, 'league', '2016-05-08 20:00:36', '2016-05-08 20:00:36'),
(36, 'BIRMINGHAM', '2016-05-08 20:00:36', '2016-05-08 20:00:36'),
(37, 'champions', '2016-05-08 20:00:36', '2016-05-08 20:00:36'),
(38, 'sport', '2016-05-08 20:02:02', '2016-05-08 20:02:02'),
(39, 'Golf', '2016-05-08 20:02:02', '2016-05-08 20:02:02'),
(40, 'Health', '2016-05-08 20:11:00', '2016-05-08 20:11:00'),
(41, 'Lessons', '2016-05-08 20:11:00', '2016-05-08 20:11:00'),
(42, 'mother''s', '2016-05-08 20:11:00', '2016-05-08 20:11:00'),
(43, 'Losser', '2016-05-08 20:13:08', '2016-05-08 20:13:08'),
(44, 'Sport''s', '2016-05-08 20:14:40', '2016-05-08 20:14:40'),
(45, 'Yoga', '2016-05-08 20:14:40', '2016-05-08 20:14:40'),
(46, 'facebook', '2016-05-24 02:33:33', '2016-05-24 02:33:33'),
(47, 'twitter', '2016-05-24 02:33:33', '2016-05-24 02:33:33'),
(48, 'whatsapp', '2016-05-24 02:33:33', '2016-05-24 02:33:33'),
(49, 'appsaver', '2016-05-24 02:33:33', '2016-05-24 02:33:33'),
(50, 'security', '2016-05-24 02:55:14', '2016-05-24 02:55:14'),
(51, 'validation', '2016-05-24 02:55:14', '2016-05-24 02:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `section` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_section_foreign` (`section`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `is_admin`, `is_active`, `section`, `remember_token`, `created_at`, `updated_at`, `confirmed`, `confirmation_code`) VALUES
(1, 'Ahmed', 'ahmed.salama1679@gmail.com', '$2y$10$0orU8sWYoG1s9ARt0.GKCOLl6O3y3Yur5xHgOboSetqvPffcKqTTC', '/users_pictures/Ahmed.jpg', 1, 1, 7, 'eqggoihI90LaM3ki7U08lQvQSXW8yDcchafY5hqWdyH3GcdH21wrx2wMZKig', '2016-05-08 18:49:01', '2016-05-25 23:15:46', 0, 'DonB98LKqGgRxbMmjjC864QPG1aKQA9ngOqjeOWQI5P5nISIFBHEbrHngT7U'),
(7, 'Ahmed Ezz', 'ahmed.ezz@gmail.com', '$2y$10$m3wdyMGOBMiRM8IR2nqU/O/SgoR8cQ564/QHUAeIcbLm8W/St6jV.', '/users_pictures/Ahmed Ezz.jpg', 1, 1, 7, 'rjt4VMB7oAAmldKBWmGkRteFmi72MgjMOOMakNhTPv3w7ZKAQMfWEnBT9YhN', '2016-05-08 19:03:56', '2016-05-08 19:11:41', 0, NULL),
(8, 'Abanoub Raffat', 'abanoub@gamil.com', '$2y$10$PUEOFrw0PsvaVdQOKLjbcenFN8ne3fPCmIWLCxNdt8CUMQuq4/SKu', '/users_pictures/Abanoub Raffat.jpg', 1, 1, 7, 'gsax6BeT8qdKJsBkG7p1knRXOWCHYCctV9YS78tQrCJI7ooZcIRXn5Iej2Bt', '2016-05-08 19:04:46', '2016-05-08 19:11:51', 0, NULL),
(9, 'Hossam Teama', 'hossam@gmail.com', '$2y$10$Xln5Jf788Egjq12z/PnE/u1x7oCQWjzza9I7Y8qbmyE/Wq9/nVRtq', '/users_pictures/Hossam Teama.jpg', 0, 1, 8, 'G6WhojTukSUvUhY43oZnD0GopMeRoJitcgdVbkZx5lSaB6OXMEm4Qw8syAcr', '2016-05-08 19:05:35', '2016-05-08 21:00:56', 0, NULL),
(10, 'Hani Shaker', 'hani@gmail.com', '$2y$10$1InOPftS8MWb3wSK2cxfa.s8wpc7e0z2TM5s/hNOED1TfAnKCyaXC', '/users_pictures/Hani Shaker.jpg', 0, 1, 9, 'sDu4MRld3kR2Ivu9zKAeRGxh4hJF7sgFywPIlC5d4tDPTh7EBZbxYXDzw2mM', '2016-05-08 19:06:09', '2016-05-25 23:48:40', 0, 'Okjnl1eDtBOByE2mDF5wbMix9X8YcJa1ofF3w8KLl4WgGP1fWcPrG1Ujik8N'),
(11, 'Shady Elshreif', 'shady@gamil.com', '$2y$10$I5..EMITkrvKXuCa0ryPge6GWWmAdeBnIvvSYfXytqGlVx9YHO9Y2', '/users_pictures/Shady Elshreif.jpg', 0, 0, 10, '5rpjSpyAvgBP6sQkYPgRDE4vB0CThsB7B808xMbCZQ8iJzeyK5pbYieA5yZI', '2016-05-08 19:07:20', '2016-05-08 20:18:51', 0, NULL),
(12, 'Mostafa Elsharkawy', 'mostafa@gmail.com', '$2y$10$/IpdN8VFwnwezCdA2gYpguaPv6fJhWrC77WIcQav0SGB1hHVUMUUq', '/users_pictures/Mostafa Elsharkawy.jpg', 0, 1, 8, 'K1e1inyW9R2Nyqv96C9i76CgrA2Rtnp8rpc5aA0RIgcWCFBrbSJQfKl2PKgJ', '2016-05-08 19:08:24', '2016-05-08 19:13:00', 0, NULL),
(13, 'Shrief Elkaiat', 'shrief@gmail.com', '$2y$10$YSkIqMSIMyrjU.rNPKOfaesMfeez.yXzUns9Nz/AlkDkqcE6F7Fiu', '/users_pictures/Shrief Elkaiat.jpg', 0, 1, 11, 'gEWve54sCgcj8u6BMAUFe4LvqtFFEcpZjdNWP3mVKWgDoEeYXApYQTNNM1rG', '2016-05-08 19:09:28', '2016-05-08 19:12:31', 0, NULL),
(14, 'Mahmoud Wael', 'mahmoud@gmail.com', '$2y$10$a223AzDducr3dUvo5PJpm.2U6zTIxzIKWO4LKhQMz4pLU/JIyNhPe', '/users_pictures/Mahmoud Wael.jpg', 0, 1, 13, '5aWVjfQ11zDtekheZuKeL3RkYTEYuLnQ9khH9FFKQHdl9LIzfS2EpcYQF3eE', '2016-05-08 19:10:07', '2016-05-08 20:02:05', 0, NULL),
(15, 'Ahmed Saed', 'ahmed@gmail.com', '$2y$10$r21WgK3qjWCRF3rq4XqhuupEbxTS248WYaek9B/OhhBMAKYy9vnHu', '/users_pictures/Ahmed Saed.jpg', 0, 1, 12, 'ZYOfVywJGan6rz5vim0EyLvQPhL5vwjepXjnkTegGflkiQABAe161I2oH0sU', '2016-05-08 19:10:33', '2016-05-08 19:12:48', 0, NULL),
(33, 'Ahmed Salama', 'ahmed.salama51@yahoo.com', '$2y$10$Ea1/BU3gQOIEWi7V8ZhIG.4AAEGZut9j4IQ4v9U2U9vY9n0SOXimq', '/users_pictures/Ahmed Salama.jpg', 0, 0, NULL, NULL, '2016-05-24 19:30:34', '2016-05-24 19:30:34', 0, 'FuLqtx3DB2F4B4R3ZA8V9SPAgCA2Kq');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_section_foreign` FOREIGN KEY (`section`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
