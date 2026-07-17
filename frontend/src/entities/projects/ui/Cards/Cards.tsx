"use client";

import { Card } from "../../../../widgets/Projects/ui/index";
import { SkeletonCard } from "../SkeletonCards";
import styles from "./Cards.module.scss";
import { useProjectsContext } from "@/entities/projects/model/ProjectsContext";

interface CardsProps {
  style?: "home" | "project";
}

export const Cards = ({ style = "home" }: CardsProps) => {
  const { projects, loading } = useProjectsContext();

  if (loading) {
    return (
      <div className={styles.wrapper}>
        <SkeletonCard />
        <SkeletonCard />
      </div>
    );
  }

  return (
    <div className={styles.wrapper}>
      <Card side="left" projects={projects} loading={false} style={style} />
      <Card side="right" projects={projects} loading={false} style={style} />
    </div>
  );
};
