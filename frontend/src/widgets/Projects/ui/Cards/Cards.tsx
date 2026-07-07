"use client";

import { Card } from "../index";
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
        <Card side="left" projects={[]} loading={true} />
        <Card side="right" projects={[]} loading={true} />
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
