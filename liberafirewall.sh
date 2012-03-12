#!/bin/sh

nslookup $1 |grep Address |grep -v '#53' |awk -F" " '{print $2}' > /tmp/$3.txt
date=`date +%d/%m/%Y-%T`
for i in `cat /tmp/$3.txt`
do
	/usr/bin/sudo ssh root@172.17.0.1 "echo 'iptables -I FORWARD -s $2/24 -d $i -j ACCEPT' >> /etc/firewall/1d.fw" 2>&1
	/usr/bin/sudo ssh root@172.17.0.1 "iptables -I FORWARD -s $2/24 -d $i -j ACCEPT"
done
echo "[$date] Usuario: $3 - IP: $2/24 - Servico: $1" >> /var/log/liberafirewall.log

echo "<div align=\"center\"><h6>IP liberado com sucesso</h6></div>"
exit 0
