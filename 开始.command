cd $(dirname $BASH_SOURCE) || {
    echo Error getting script directory >&2
    exit 1
}
nohup php -S localhost:8008 -t . &
open -a Safari key.html & php look.php
