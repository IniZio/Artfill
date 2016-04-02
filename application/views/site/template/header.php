<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</head>
<body>
	
</body>	
<!-- header start -->
<header>
	<?php if ($this->session->userdata['username']) ==''{?>
		<!-- //require: show register+login button if not loginned -->
	<?php}
	else {?>
		<!-- //require show user action button if loginned -->
	<?php }?>
</header>