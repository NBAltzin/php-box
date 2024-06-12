<h2>PHP推箱子小游戏</h2>
使用上下左右方向键<br />
<?php
echo "键码:" . $_GET["key"] . "<br/>";
$key = (int)$_GET["key"];
$keys = [38 => "上", 40 => "下", 37 => "左", 39 => "右"];
echo isset($keys[$_GET["key"]]) ? $keys[$_GET["key"]] : "其它按键";
echo "<br/>";
if (!isset($keys[$_GET["key"]])) {
    exit;
}
//上 38
//下 40
//左 37
//右 39
if (file_get_contents("win.txt") == "1") {
    echo "你赢了，请重新打开网页<br/>";
    exit;
}
$map = json_decode(file_get_contents("map.json"), true);
$find = 0;
$stlie = null;
$sthang = null;
foreach ($map as $rownum => $rowline) {
    foreach ($rowline as $colnum => $m) {
        if ($m == "你") {
            $sthang = $rownum;
            $stlie = $colnum;
            $find = 1;
            break 2;
        }
    }
}
if ($find == 0) {
    echo "错误:没有起点<br/>";
    exit;
}
switch ($key) {
    case 38:
        if (isset($map[$sthang - 1][$stlie])) {
            switch ($map[$sthang - 1][$stlie]) {
                case "地":
                    $map[$sthang - 1][$stlie] = "你";
                    $map[$sthang][$stlie] = "地";
                    break;
                case "墙":
                    break;
                case "炸":
                    if (isset($map[$sthang - 2][$stlie])) {
                        switch ($map[$sthang - 2][$stlie]) {
                            case "地":
                                $map[$sthang - 2][$stlie] = "炸";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                $map[$sthang - 2][$stlie] = "地";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang - 2][$stlie] = "纟";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang - 2][$stlie] = "地";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang - 2][$stlie] = "纟";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang - 2][$stlie] = "地";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点没了,化+炸可产生纟<br/>";
                                break;
                            case "炸":
                                $map[$sthang - 2][$stlie] = "化";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "箱":
                    if (isset($map[$sthang - 2][$stlie])) {
                        switch ($map[$sthang - 2][$stlie]) {
                            case "地":
                                $map[$sthang - 2][$stlie] = "箱";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang - 2][$stlie] = "箱";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "你赢了，请重新打开网页<br/>";
                                file_put_contents("win.txt", "1");
                                break;
                            case "炸":
                                $map[$sthang - 2][$stlie] = "地";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang - 2][$stlie] = "墙";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                        }
                    }
                    break;
                case "终":
                    echo "把箱子推进去，而不是你进去<br/>";
                    break;
                case "纟":
                    if (isset($map[$sthang - 2][$stlie])) {
                        switch ($map[$sthang - 2][$stlie]) {
                            case "地":
                                $map[$sthang - 2][$stlie] = "纟";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                break;
                            case "箱":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "化":
                                $map[$sthang - 2][$stlie] = "终";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang - 2][$stlie] = "终";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang - 2][$stlie] = "地";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "化":
                    if (isset($map[$sthang - 2][$stlie])) {
                        switch ($map[$sthang - 2][$stlie]) {
                            case "地":
                                $map[$sthang - 2][$stlie] = "化";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                $map[$sthang - 2][$stlie] = "纟";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang - 2][$stlie] = "墙";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang - 2][$stlie] = "纟";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang - 2][$stlie] = "箱";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang - 2][$stlie] = "终";
                                $map[$sthang - 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
            }
        }
        break;
    case 40:
        if (isset($map[$sthang + 1][$stlie])) {
            switch ($map[$sthang + 1][$stlie]) {
                case "地":
                    $map[$sthang + 1][$stlie] = "你";
                    $map[$sthang][$stlie] = "地";
                    break;
                case "墙":
                    break;
                case "炸":
                    if (isset($map[$sthang + 2][$stlie])) {
                        switch ($map[$sthang + 2][$stlie]) {
                            case "地":
                                $map[$sthang + 2][$stlie] = "炸";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                $map[$sthang + 2][$stlie] = "地";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang + 2][$stlie] = "纟";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang + 2][$stlie] = "地";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang + 2][$stlie] = "纟";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang + 2][$stlie] = "地";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点没了,化+炸可产生纟<br/>";
                                break;
                            case "炸":
                                $map[$sthang + 2][$stlie] = "化";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "箱":
                    if (isset($map[$sthang + 2][$stlie])) {
                        switch ($map[$sthang + 2][$stlie]) {
                            case "地":
                                $map[$sthang + 2][$stlie] = "箱";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang + 2][$stlie] = "箱";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "你赢了，请重新打开网页<br/>";
                                file_put_contents("win.txt", "1");
                                break;
                            case "炸":
                                $map[$sthang + 2][$stlie] = "地";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang + 2][$stlie] = "墙";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                        }
                    }
                    break;
                case "终":
                    echo "把箱子推进去，而不是你进去<br/>";
                    break;
                case "纟":
                    if (isset($map[$sthang + 2][$stlie])) {
                        switch ($map[$sthang + 2][$stlie]) {
                            case "地":
                                $map[$sthang + 2][$stlie] = "纟";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                break;
                            case "箱":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "化":
                                $map[$sthang + 2][$stlie] = "终";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang + 2][$stlie] = "终";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang + 2][$stlie] = "地";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "化":
                    if (isset($map[$sthang + 2][$stlie])) {
                        switch ($map[$sthang + 2][$stlie]) {
                            case "地":
                                $map[$sthang + 2][$stlie] = "化";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                $map[$sthang + 2][$stlie] = "纟";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang + 2][$stlie] = "墙";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang + 2][$stlie] = "纟";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang + 2][$stlie] = "箱";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang + 2][$stlie] = "终";
                                $map[$sthang + 1][$stlie] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
            }
        }
        break;
    case 37:
        if (isset($map[$sthang][$stlie - 1])) {
            switch ($map[$sthang][$stlie - 1]) {
                case "地":
                    $map[$sthang][$stlie - 1] = "你";
                    $map[$sthang][$stlie] = "地";
                    break;
                case "墙":
                    break;
                case "炸":
                    if (isset($map[$sthang][$stlie - 2])) {
                        switch ($map[$sthang][$stlie - 2]) {
                            case "地":
                                $map[$sthang][$stlie - 2] = "炸";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                $map[$sthang][$stlie - 2] = "地";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang][$stlie - 2] = "纟";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang][$stlie - 2] = "地";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie - 2] = "纟";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie - 2] = "地";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点没了,化+炸可产生纟<br/>";
                                break;
                            case "炸":
                                $map[$sthang][$stlie - 2] = "化";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "箱":
                    if (isset($map[$sthang][$stlie - 2])) {
                        switch ($map[$sthang][$stlie - 2]) {
                            case "地":
                                $map[$sthang][$stlie - 2] = "箱";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang][$stlie - 2] = "箱";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "你赢了，请重新打开网页<br/>";
                                file_put_contents("win.txt", "1");
                                break;
                            case "炸":
                                $map[$sthang][$stlie - 2] = "地";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie - 2] = "墙";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                        }
                    }
                    break;
                case "终":
                    echo "把箱子推进去，而不是你进去<br/>";
                    break;
                case "纟":
                    if (isset($map[$sthang][$stlie - 2])) {
                        switch ($map[$sthang][$stlie - 2]) {
                            case "地":
                                $map[$sthang][$stlie - 2] = "纟";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                break;
                            case "箱":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "化":
                                $map[$sthang][$stlie - 2] = "终";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie - 2] = "终";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang][$stlie - 2] = "地";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "化":
                    if (isset($map[$sthang][$stlie - 2])) {
                        switch ($map[$sthang][$stlie - 2]) {
                            case "地":
                                $map[$sthang][$stlie - 2] = "化";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                $map[$sthang][$stlie - 2] = "纟";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang][$stlie - 2] = "墙";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang][$stlie - 2] = "纟";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie - 2] = "箱";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie - 2] = "终";
                                $map[$sthang][$stlie - 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
            }
        }
        break;
    case 39:
        if (isset($map[$sthang][$stlie + 1])) {
            switch ($map[$sthang][$stlie + 1]) {
                case "地":
                    $map[$sthang][$stlie + 1] = "你";
                    $map[$sthang][$stlie] = "地";
                    break;
                case "墙":
                    break;
                case "炸":
                    if (isset($map[$sthang][$stlie + 2])) {
                        switch ($map[$sthang][$stlie + 2]) {
                            case "地":
                                $map[$sthang][$stlie + 2] = "炸";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                $map[$sthang][$stlie + 2] = "地";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang][$stlie + 2] = "纟";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang][$stlie + 2] = "地";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie + 2] = "纟";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie + 2] = "地";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点没了,化+炸可产生纟<br/>";
                                break;
                            case "炸":
                                $map[$sthang][$stlie + 2] = "化";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "箱":
                    if (isset($map[$sthang][$stlie + 2])) {
                        switch ($map[$sthang][$stlie + 2]) {
                            case "地":
                                $map[$sthang][$stlie + 2] = "箱";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "终":
                                $map[$sthang][$stlie + 2] = "箱";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "你赢了，请重新打开网页<br/>";
                                file_put_contents("win.txt", "1");
                                break;
                            case "炸":
                                $map[$sthang][$stlie + 2] = "地";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie + 2] = "墙";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                        }
                    }
                    break;
                case "终":
                    echo "把箱子推进去，而不是你进去<br/>";
                    break;
                case "纟":
                    if (isset($map[$sthang][$stlie + 2])) {
                        switch ($map[$sthang][$stlie + 2]) {
                            case "地":
                                $map[$sthang][$stlie + 2] = "纟";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                break;
                            case "箱":
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "化":
                                $map[$sthang][$stlie + 2] = "终";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie + 2] = "终";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang][$stlie + 2] = "地";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
                case "化":
                    if (isset($map[$sthang][$stlie + 2])) {
                        switch ($map[$sthang][$stlie + 2]) {
                            case "地":
                                $map[$sthang][$stlie + 2] = "化";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "墙":
                                break;
                            case "终":
                                $map[$sthang][$stlie + 2] = "纟";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                echo "终点坏了,可使用化修复<br/>";
                                break;
                            case "箱":
                                $map[$sthang][$stlie + 2] = "墙";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "炸":
                                $map[$sthang][$stlie + 2] = "纟";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "化":
                                $map[$sthang][$stlie + 2] = "箱";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                            case "纟":
                                $map[$sthang][$stlie + 2] = "终";
                                $map[$sthang][$stlie + 1] = "你";
                                $map[$sthang][$stlie] = "地";
                                break;
                        }
                    }
                    break;
            }
        }
        break;
}




$json = json_encode($map);
file_put_contents("map.json", $json);
