Dim oShell
			Set oShell = WScript.CreateObject ("WScript.Shell")
			oShell.run "cmd /k cd/. & cd xampp/apache/bin & htpasswd.exe -c -b C:\xampp\htdocs\FTn50\files\skkkka\.htpasswd user 123& cd/. & exit "