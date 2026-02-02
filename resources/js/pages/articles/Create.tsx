import { Head, router } from "@inertiajs/react"
import axios from "axios"
import { useState } from "react"

import { Button } from "@/components/ui/button"
import { Card, CardHeader, CardTitle, CardContent } from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import AppLayout from '@/layouts/app-layout';
import { home } from '@/routes';
import { create } from '@/routes/articles';
import type { BreadcrumbItem } from '@/types';

export default function ArticlesCreate() {
    const [title, setTitle] = useState("")
    const [content, setContent] = useState("")
    const [loading, setLoading] = useState(false)
    const [errors, setErrors] = useState({})
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Список статей',
            href: home().url,
        },
        {
            title: 'Создание статьи',
            href: create().url,
        },
    ];

    const submit = () => {
        setLoading(true)
        setErrors({})

        axios.post("/api/articles", {
            title,
            content,
        })
            .then(res => {
                console.log(res)
                router.visit(`/articles/${res.data.data.id}`);
            })
            .catch(err => {
                if (err.response?.status === 422) {
                    setErrors(err.response.data.errors)
                }
            })
            .finally(() => setLoading(false))
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Список статей" />
        <div className="max-w-3xl mx-auto p-6">
            <Card className="bg-zinc-900">
                <CardHeader>
                    <CardTitle className="text-white">
                        Создание статьи
                    </CardTitle>
                </CardHeader>

                <CardContent className="space-y-5">
                    {/* Title */}
                    <div className="space-y-1">
                        <Label className="text-zinc-300">Заголовок</Label>
                        <Input
                            value={title}
                            onChange={e => setTitle(e.target.value)}
                            placeholder="Введите заголовок статьи"
                        />
                        {errors.title && (
                            <p className="text-sm text-red-500">
                                {errors.title[0]}
                            </p>
                        )}
                    </div>

                    {/* Content */}
                    <div className="space-y-1">
                        <Label className="text-zinc-300">Текст статьи</Label>

                        <textarea
                            value={content}
                            onChange={e => setContent(e.target.value)}
                            placeholder="Полный текст статьи..."
                            rows={10}
                            className="
                w-full rounded-md bg-zinc-950 border border-zinc-800
                text-zinc-100 px-3 py-2 text-sm
                focus:outline-none focus:ring-2 focus:ring-zinc-700
              "
                        />

                        {errors.content && (
                            <p className="text-sm text-red-500">
                                {errors.content[0]}
                            </p>
                        )}
                    </div>

                    {/* Actions */}
                    <div className="flex justify-end gap-3">
                        <Button
                            variant="outline"
                            onClick={() => history.back()}
                        >
                            Отмена
                        </Button>

                        <Button
                            onClick={submit}
                            disabled={loading || !title || !content}
                        >
                            {loading ? "Создание..." : "Создать"}
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
    )
}
