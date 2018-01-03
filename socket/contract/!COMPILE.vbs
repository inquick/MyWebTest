On Error Resume Next

Do
    Set shell = CreateObject("WScript.Shell")
    If shell Is Nothing Then Exit Do
    Set fs = CreateObject("Scripting.FileSystemObject")
    If fs Is Nothing Then Exit Do

    If LCase(fs.GetFileName(WScript.FullName)) = "wscript.exe" Then
        shell.Run "cscript.exe " & Chr(34) & WScript.ScriptFullName & Chr(34), vbHide
        Exit Do
    End If

    Set folder = fs.GetFolder(".")
    if folder Is Nothing Then Exit Do

    Dim errorMsg

    For Each file In folder.Files
        If fs.GetExtensionName(file) = "proto" Then
            baseName = fs.GetBaseName(file)

            proto = fs.GetFile(baseName & ".proto").DateLastModified
            pbphp = fs.GetFile(baseName & ".php").DateLastModified

            If proto > pbphp Then
                Set ps = shell.Exec("protoc --plugin=protoc-gen-php --php_out=. " & baseName & ".proto")

                Do While Not ps.StdErr.AtEndOfStream
                    errorMsg = errorMsg & ps.StdErr.ReadAll()
                Loop
            End If

            Set proto = Nothing
            Set pbphp = Nothing
        End If
    Next

    If Len(errorMsg) > 0 Then MsgBox errorMsg, vbCritical, "³ö´íÀ²£¡"
Loop While False